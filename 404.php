<?php
/**
 * Standalone Minimalist 404 Error Template for Twenty Twenty-Five Theme.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - 页面未找到 | <?php bloginfo( 'name' ); ?></title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            text-align: center;
        }
        .container-404 {
            max-width: 600px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .logo-404 {
            height: 52px;
            width: auto;
            margin-bottom: 20px;
        }
        .number-404 {
            font-size: 140px;
            font-weight: 900;
            line-height: 1;
            color: #e40011;
            letter-spacing: -4px;
            margin: 10px 0;
            text-shadow: 0 10px 30px rgba(228, 0, 17, 0.12);
        }
        .title-404 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }
        .subtitle-404 {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 35px;
            line-height: 1.6;
        }
        .btn-group-404 {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-404 {
            padding: 14px 28px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
        }
        .btn-back:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }
        .btn-home {
            background-color: #e40011;
            color: #ffffff;
            border: 1px solid #e40011;
            box-shadow: 0 4px 12px rgba(228, 0, 17, 0.25);
        }
        .btn-home:hover {
            background-color: #c8000f;
            border-color: #c8000f;
        }
    </style>
</head>
<body>
    <div class="container-404">
        <!-- Official Logo -->
        <a href="/">
            <img src="https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/4ee68ec9-3343-45a5-ae29-ba57da8e707e.png" alt="<?php bloginfo( 'name' ); ?>" class="logo-404" />
        </a>

        <!-- Huge 404 Number -->
        <div class="number-404">404</div>

        <!-- Chinese Notice -->
        <h1 class="title-404">抱歉，您可能走错了方向！</h1>
        <p class="subtitle-404">您访问的页面不存在或已被删除。您可以选择返回上一页或直接前往网站首页。</p>

        <!-- Action Buttons -->
        <div class="btn-group-404">
            <a href="javascript:history.back();" class="btn-404 btn-back">
                &larr; 返回上一页
            </a>
            <a href="/" class="btn-404 btn-home">
                返回网站首页 &rarr;
            </a>
        </div>
    </div>
</body>
</html>
