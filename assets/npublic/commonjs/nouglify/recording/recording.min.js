$define(['cmsAjax',"/npublic/commonjs/jsencrypt.js","/npublic/commonjs/nouglify/jquery.md5.js","pl_toast"], (c)=> {
    class recording {
        constructor(option) {
            this.stream = null;
            this.audioContext = null;
            this.processor = null;
            this.input = null;
            this.pcmData = []; // 存放录音的 PCM 数据块
            this.sampleRate = null;
        }
        async startRecording(callback) {
            this.stream = null;
            this.audioContext = null;
            this.processor = null;
            this.input = null;
            this.pcmData = []; // 存放录音的 PCM 数据块
            this.sampleRate = null;
          
            if(!this.stream){
                this.initMac((res)=>{
                    if(res=='error'){
                        callback('error')
                    }else{
                        this.recordFunc(callback)
                    }   
                })
            }else{
                this.recordFunc(callback)
            }
        }
        recordFunc(callback){
            this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
            this.sampleRate = this.audioContext.sampleRate; // 通常是 48000

            this.input = this.audioContext.createMediaStreamSource(this.stream);
            this.processor = this.audioContext.createScriptProcessor(4096, 1, 1);

            this.input.connect(this.processor);
            this.processor.connect(this.audioContext.destination);

            this.processor.onaudioprocess = (e) => {
                const channelData = e.inputBuffer.getChannelData(0);
                this.pcmData.push(new Float32Array(channelData)); // 保存 float32 数据
            };

            console.log("录音开始, 采样率:", this.sampleRate);

            callback()
        }
        async initMac(callback){
            try {
                this.stream = await navigator.mediaDevices.getUserMedia({ audio: { deviceId: "default" } });
                console.log("已获取麦克风权限", this.stream);
                callback()
            } catch (err) {
                callback('error')
                console.error("麦克风访问失败:", err);
                // 根据不同错误类型提示用户
                switch (err.name) {
                    case "NotAllowedError":
                        $.pl_toast({msg:"您已拒绝使用麦克风，请在浏览器设置中重新授权。"})
                        break;
                    case "NotFoundError":
                        $.pl_toast({msg:"未检测到可用的麦克风设备。"})
                        break;
                    case "NotReadableError":
                        $.pl_toast({msg:"麦克风可能被其他应用占用，请关闭其他占用麦克风的程序后重试。"})
                        break;
                    case "OverconstrainedError":
                        $.pl_toast({msg:"没有找到符合要求的麦克风设备。"})
                        break;
                    case "NotSupportedError":
                        $.pl_toast({msg:"当前浏览器不支持麦克风访问。"})
                        break;
                    default:
                        $.pl_toast({msg:"获取麦克风权限失败，请检查设备和浏览器设置。"})
                }
            }
        }
        async stopRecording(callback) {
            if (this.processor) {
                // 停止采集
                this.processor.disconnect();
                this.input.disconnect();
                this.stream.getTracks().forEach(track => track.stop());
                await this.audioContext.close();

                // 拼接 PCM
                const merged = this.mergeFloat32Array(this.pcmData);
                this.pcmData = [];

                // 重采样到 16kHz
                const resampled = await this.resampleBuffer(merged, this.sampleRate, 16000);
                // 转成 Int16 PCM
                const pcm16 = this.floatTo16BitPCM(resampled);

                // 现在 pcm16 就是 Uint8Array，可直接传给后端
                console.log("录音结束，16kHz PCM 数据长度: " + pcm16.byteLength);
                // 转成 WAV
                // const wavBlob = this.encodeWAV(resampled, 16000);
                // const blob = new Blob([pcm16], { type: "application/octet-stream" });
                const file = new File([pcm16], "record_16k.pcm", { type: "application/octet-stream" });
                // const url = URL.createObjectURL(blob);
                // let a = document.createElement('a')
                // a.href = url
                // a.download = "record_16k.pcm"
                // a.click()
                
                this.getToken(()=>{
                    let token = sessionStorage.getItem("smsAudioToken")
                    this.sendPCMToServer(file,token,callback)
                })

                console.log("已导出 16kHz WAV 并上传");
            }
        }
        async resampleBuffer(float32Array, inputSampleRate, targetSampleRate) {
            const audioBuffer = new AudioBuffer({
                length: float32Array.length,
                sampleRate: inputSampleRate,
                numberOfChannels: 1
            });
            audioBuffer.copyToChannel(float32Array, 0);

            const offlineCtx = new OfflineAudioContext(1, Math.ceil(audioBuffer.duration * targetSampleRate), targetSampleRate);
            const bufferSource = offlineCtx.createBufferSource();
            bufferSource.buffer = audioBuffer;
            bufferSource.connect(offlineCtx.destination);
            bufferSource.start();

            const rendered = await offlineCtx.startRendering();
            return rendered.getChannelData(0); // 返回 Float32Array
        }
        getToken(callback){
            let url = "/fwebapi/visitor/lowcode/intelligent/audio/getAudioToken"
            let p = $.nrsa(`designVue&${$.md5(navigator.userAgent)}`,'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCdBbSMUKBY3wW8C/RFFwFoTHyO8xM67xBtgERb/4z6dqUq2ZeTagHUT6tbnuvhug0FNU9t/bzBc6KOivkzPToYYJG/RDzvdAJTjdvvvu3WQUpKOa0s0V3ehkKRoZPIFw3YnahtUrIe9es0V0LlTkOyFlH2M6rpceC7K0XgEs7lZwIDAQAB')
            c.cmsAjax.get(url,{},{headers:{authCode:p}}).then((res)=>{
                if(res && res.data && res.data.token){
                    sessionStorage.setItem("smsAudioToken",res.data.token)
                    callback()
                }
            })
        }
        async sendPCMToServer(file,token,callback) {
            let url = `/fwebapi/visitor/lowcode/intelligent/audio/getAudio2Text`
            const formData = new FormData();
            formData.append("uploadFile", file);
            formData.append("token", token);
            formData.append("format", 'pcm');
            formData.append("rate", 16000);
            await fetch(url, { method: "POST", body: formData }).then(res=>res.json()).then(res=>{
                callback(res)
            });
        }   
        mergeFloat32Array(chunks) {
            let totalLength = chunks.reduce((sum, arr) => sum + arr.length, 0);
            let result = new Float32Array(totalLength);
            let offset = 0;
            chunks.forEach(arr => {
                result.set(arr, offset);
                offset += arr.length;
            });
            return result;
        }
        // 工具函数：Float32 → Int16 PCM
        floatTo16BitPCM(float32Array) {
            const buffer = new ArrayBuffer(float32Array.length * 2);
            const view = new DataView(buffer);
            let offset = 0;
            for (let i = 0; i < float32Array.length; i++, offset += 2) {
                let s = Math.max(-1, Math.min(1, float32Array[i]));
                view.setInt16(offset, s < 0 ? s * 0x8000 : s * 0x7FFF, true);
            }
            return new Uint8Array(buffer);
        }
        // 拼接 PCM + 写 WAV 头
        encodeWAV(samples, sampleRate) {
            const buffer = new ArrayBuffer(44 + samples.length * 2);
            const view = new DataView(buffer);

            function writeString(view, offset, string) {
                for (let i = 0; i < string.length; i++) {
                view.setUint8(offset + i, string.charCodeAt(i));
                }
            }

            const numChannels = 1;
            const bitsPerSample = 16;
            const blockAlign = numChannels * bitsPerSample / 8;
            const byteRate = sampleRate * blockAlign;

            writeString(view, 0, 'RIFF');
            view.setUint32(4, 36 + samples.length * 2, true);
            writeString(view, 8, 'WAVE');
            writeString(view, 12, 'fmt ');
            view.setUint32(16, 16, true);
            view.setUint16(20, 1, true);
            view.setUint16(22, numChannels, true);
            view.setUint32(24, sampleRate, true);
            view.setUint32(28, byteRate, true);
            view.setUint16(32, blockAlign, true);
            view.setUint16(34, bitsPerSample, true);
            writeString(view, 36, 'data');
            view.setUint32(40, samples.length * 2, true);

            let offset = 44;
            for (let i = 0; i < samples.length; i++, offset += 2) {
                let s = Math.max(-1, Math.min(1, samples[i]));
                view.setInt16(offset, s < 0 ? s * 0x8000 : s * 0x7FFF, true);
            }

            return new Blob([view], { type: "audio/wav" });
        }
    };
    return recording
})