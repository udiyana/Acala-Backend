<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acala Bar & Bistro — Backend API Server</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-bg: #0f172a;
            --color-card: #1e293b;
            --color-border: #334155;
            --color-primary: #e11d48;
            --color-primary-hover: #be123c;
            --color-success: #10b981;
            --color-text: #f8fafc;
            --color-text-muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 800px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2.25rem;
            color: #ffffff;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--color-success);
            padding: 0.35rem 0.85rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background-color: var(--color-success);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--color-success);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .card {
            background: var(--color-card);
            border: 1px solid var(--color-border);
            border-radius: 1rem;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: var(--color-primary-hover);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: rgba(255, 255, 255, 0.08);
            color: var(--color-text);
            border: 1px solid var(--color-border);
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .endpoint-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .endpoint-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--color-border);
            border-radius: 0.5rem;
            font-family: monospace;
            font-size: 0.875rem;
        }

        .method {
            padding: 0.2rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 700;

        }

        .method-get { background: rgba(59, 130, 246, 0.2); color: #60a5fa; }
        .method-post { background: rgba(16, 185, 129, 0.2); color: #34d399; }

        .endpoint-url {
            color: var(--color-text-muted);
            text-decoration: none;
        }

        .endpoint-url:hover {
            color: var(--color-text);
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            color: var(--color-text-muted);
            font-size: 0.875rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-title">🍷 Acala Bar & Bistro</div>
            <p style="color: var(--color-text-muted); margin-bottom: 1rem;">Laravel API Service</p>
            <div class="badge-status">
                <span class="pulse-dot"></span>
                <span>Backend Server Active (Port 8000)</span>
            </div>
        </div>

        <div class="card">
            <div class="card-title">🚀 Mode Terpisah (Decoupled Architecture)</div>
            <p style="color: var(--color-text-muted); line-height: 1.6;">
                Proyek ini telah dipisahkan menjadi 2 bagian. Folder ini adalah <strong>acala-backend</strong> yang menyediakan layanan REST API murni untuk konten situs, dataset menu, galeri, dan CMS admin.
            </p>

            <div class="btn-group">
                <a href="http://localhost:5173" class="btn btn-primary" target="_blank">
                    🌐 Buka Aplikasi Frontend (Port 5173) &rarr;
                </a>
                <a href="/health" class="btn btn-secondary">
                    🔍 Cek Health API
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-title">📡 Public API Endpoints</div>
            <div class="endpoint-list">
                <div class="endpoint-item">
                    <div>
                        <span class="method method-get">GET</span>
                        <a href="/api/cms/public-datasets" class="endpoint-url" target="_blank">/api/cms/public-datasets</a>
                    </div>
                    <span style="color: var(--color-text-muted);">Datasets (Menu, Branches, Review)</span>
                </div>

                <div class="endpoint-item">
                    <div>
                        <span class="method method-get">GET</span>
                        <a href="/api/cms/public/home" class="endpoint-url" target="_blank">/api/cms/public/home</a>
                    </div>
                    <span style="color: var(--color-text-muted);">Home Page CMS Content</span>
                </div>

                <div class="endpoint-item">
                    <div>
                        <span class="method method-get">GET</span>
                        <a href="/api/cms/public-images" class="endpoint-url" target="_blank">/api/cms/public-images</a>
                    </div>
                    <span style="color: var(--color-text-muted);">Public Image Library</span>
                </div>

                <div class="endpoint-item">
                    <div>
                        <span class="method method-post">POST</span>
                        <span class="endpoint-url">/api/cms/login</span>
                    </div>
                    <span style="color: var(--color-text-muted);">CMS Admin Login</span>
                </div>
            </div>
        </div>

        <div class="footer">
            Acala Bar & Bistro &bull; Laravel {{ app()->version() }} &bull; PHP {{ PHP_VERSION }}
        </div>
    </div>
</body>
</html>
