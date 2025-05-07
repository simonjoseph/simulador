<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não Encontrada</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .error-container {
            text-align: center;
            background: #fff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .error-container img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 64px;
            color: #e74c3c;
            margin: 0;
        }

        p {
            font-size: 18px;
            color: #555;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #2ecc71;
            margin-left: 10px;
        }

        .btn-secondary:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <img src="public/images/logo.png" alt="Página Não Encontrada">
        <!-- <h1>404</h1> -->
        <p>Ops! A página que você está procurando não foi encontrada.</p>
        <p>Talvez você tenha digitado o endereço errado ou a página não existe mais.</p>
        <a href="javascript:history.back()" class="btn">Voltar</a>
        <a href="/simulador" class="btn btn-secondary">Ir para a Página Inicial</a>
    </div>
</body>
</html>