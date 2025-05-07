<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #00C389, #43b029);
            overflow: hidden;
        }
        
        .container {
            position: relative;
            width: 400px;
            height: 500px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            padding: 40px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .header h1 {
            color: #333;
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #666;
            font-size: 1rem;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 30px;
        }
        
        .form-group input {
            width: 100%;
            padding: 15px 20px;
            background: #f5f5f5;
            border: none;
            outline: none;
            border-radius: 10px;
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus {
            background: #fff;
            box-shadow: 0 0 0 2px #00C389;
        }
        
        .form-group label {
            position: absolute;
            top: 15px;
            left: 20px;
            color: #999;
            font-size: 1rem;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus ~ label,
        .form-group input:valid ~ label {
            top: -10px;
            left: 15px;
            font-size: 0.8rem;
            background: #fff;
            padding: 0 5px;
            color: #00C389;
        }
        
        .remember {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .remember input {
            margin-right: 10px;
            accent-color: #00C389;
        }
        
        .remember label {
            color: #666;
        }
        
        .forgot {
            text-align: right;
            margin-bottom: 30px;
        }
        
        .forgot a {
            color: #00C389;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot a:hover {
            text-decoration: underline;
        }
        
        .btn {
            width: 100%;
            padding: 15px 0;
            background: linear-gradient(135deg, #00C389, #43b029);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(174, 119, 227, 0.4);
        }
        
        .signup {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }
        
        .signup a {
            color: #00C389;
            text-decoration: none;
            font-weight: 600;
        }
        
        .signup a:hover {
            text-decoration: underline;
        }
        
        .circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(174, 119, 227, 0.1);
            animation: animate 25s linear infinite;
            bottom: -150px;
            border-radius: 50%;
        }
        
        .circles li:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }
        
        .circles li:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }
        
        .circles li:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }
        
        .circles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }
        
        .circles li:nth-child(5) {
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
        }
        
        .circles li:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }
        
        .circles li:nth-child(7) {
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
        }
        
        .circles li:nth-child(8) {
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }
        
        .circles li:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
        }
        
        .circles li:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
        }
        
        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }
        
        /* Responsividade */
        @media (max-width: 480px) {
            .container {
                width: 90%;
                padding: 30px 20px;
            }
            
            .header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bem-vindo</h1>
            <p>Por favor, faça login para continuar</p>
        </div>

        <!-- Exibir mensagem de erro, se existir -->
        <?php if (!empty($error)): ?>
            <div class="error-message" style="color: red; text-align: center; margin-bottom: 20px;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- Adicionando o formulário -->
        <form action="/simulador/login/authenticate" method="POST">
            <div class="form-group">
                <input type="text" name="username" id="email" required>
                <label for="email">Email</label>
            </div>
            
            <div class="form-group">
                <input type="password" name="password" id="password" required>
                <label for="password">Senha</label>
            </div>
            
            <div class="remember">
                <input type="checkbox" id="remember">
                <label for="remember">Lembrar-me</label>
            </div>
            
            <div class="forgot">
                <a href="#">Esqueceu a senha?</a>
            </div>
            
            <button type="submit" class="btn">Entrar</button>
        </form>
        
        <div class="signup">
            <p>Não tem uma conta? <a href="#">Cadastre-se</a></p>
        </div>
        
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>
</html>