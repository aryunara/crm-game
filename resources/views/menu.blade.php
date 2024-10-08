<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<nav>
    <ul>
        <li><a data-title="Начните приключение!" id="jogar-btn">ИГРАТЬ!</a></li>
        <li><a data-title="Настройки игры" id="op-btn">НАСТРОЙКИ</a></li>
    </ul>
</nav>

<section id="login">
    <header>
        Логин
        <div class="close"></div>
    </header>
    <div>
        <p>Введите данные для входа:</p>
        <form method="POST" action="{{ route('post.login') }}">
            @csrf

            <input type="email" name="email" id="email" placeholder="Электронная почта"/><br/>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

            <input type="password" name="password" id="password" placeholder="Пароль"/><br/>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror

            <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-dark btn-block">Войти</button>
            </div>

            <p>Нет аккаунта? <a href="#" id="register-link">Создать</a></p>
        </form>
    </div>
</section>

<section id="register">
    <header>
        Регистрация
        <div class="close"></div>
    </header>
    <div>
        <p>Введите данные для регистрации:</p>
        <form method="POST" action="{{ route('post.register') }}">
            @csrf

            <input type="email" name="email" id="reg-email" placeholder="Электронная почта"/><br/>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

            <input type="text" name="name" id="name" placeholder="Имя пользователя"/><br/>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror

            <input type="password" name="password" id="reg-password" placeholder="Пароль"/><br/>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror

            <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-dark btn-block">Регистрация</button>
            </div>

            <p>Уже есть аккаунт? <a href="#" id="login-link">Войти</a></p>
        </form>
    </div>
</section>

<section id="opcoes">
    <header>
        Настройки
        <div class="close"></div>
    </header>
    <div>
        <p>Загрузить экран</p>
    </div>
</section>

<script>
    $(document).ready(function(){
        var isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

        $("#jogar-btn").click(function(){
            if (isAuthenticated) {
                window.location.href = "{{ route('main') }}";
            } else {
                toggleSection("#login");
            }
        });

        $("#op-btn").click(function(){
            toggleSection("#opcoes");
        });

        $(".close").click(function() {
            $(this).closest('section').removeClass("active");
        });

        $("#register-link").click(function(event){
            event.preventDefault();
            toggleSection("#register", "#login");
        });

        $("#login-link").click(function(event){
            event.preventDefault();
            toggleSection("#login", "#register");
        });

        function toggleSection(showSection, hideSection) {
            if (hideSection) $(hideSection).removeClass("active");
            $(showSection).addClass("active");
        }
    });
</script>

<style>
    @import url(https://fonts.googleapis.com/css?family=Kite+One);
    @import url(https://fonts.googleapis.com/css?family=Offside);
    html,
    body {
        height: 100%;
        margin: 0;
    }
    body {
        background: #0d6050;
        font: normal 1.1em Calibri;
    }
    nav {
        height: 25%;
        width: 30%;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        font: normal 1.2em Offside;
    }
    p {
        margin: 5px 0;
    }
    li a {
        display: block;
    }
    a {
        text-decoration: none;
        color: #eee;
        transition: all linear 0.3s;
    }
    a:hover {
        color: #ecbb15;
        position: relative;
        cursor: pointer;
        text-shadow: rgb(172, 136, 15) 0px 1px 0px, rgb(108, 86, 10) 0px 2px 0px,
        rgba(0, 0, 0, 0.199219) 0px 3px 1px, rgba(0, 0, 0, 0.296875) 0px 4px 2px;
        transition: all linear 0.3s;
    }
    li a:after {
        content: attr(data-title);
        padding: 4px 8px;
        line-height: 100%;
        color: #fff;
        position: absolute;
        left: 40%;
        top: 70%;
        white-space: nowrap;
        z-index: 20px;
        font-size: 0.7em;
        background: rgba(23, 172, 144, 0.8);
        opacity: 0;
        text-shadow: none;
    }
    li a:hover:after {
        opacity: 1;
        transition: all linear 0.5s 0.2s;
    }
    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    li {
        width: 100%;
        text-align: center;
        line-height: 2.5em;
        float: left;
    }
    li:first-child {
        line-height: 60px;
        font-size: 1.5em;
        text-shadow: rgb(187, 187, 187) 0px 1px 0px, rgb(181, 181, 181) 0px 2px 0px,
        rgba(0, 0, 0, 0.199219) 0px 3px 1px, rgba(0, 0, 0, 0.296875) 0px 4px 3px;
    }
    li:first-child a:hover {
        -webkit-animation: anim infinite 1.5s;
    }
    @-webkit-keyframes anim {
        0% {
            -webkit-transform: rotate(4deg);
        }
        50% {
            -webkit-transform: rotate(-4deg);
        }
        100% {
            -webkit-transform: rotate(4deg);
        }
    }
    section {
        width: 400px;
        background: #222;
        color: #fff;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%) scale(0.6);
        opacity: 0;
        z-index: -1;
        transition: all 0.3s ease-in;
        box-shadow: 0 0 20px #000;
        font: normal 1em "Kite One";
    }
    header {
        height: 32px;
        padding: 0 8px;
        line-height: 32px;
        color: #000;
        background: #17ac90;
        font-weight: bold;
        font-size: 0.9em;
    }
    section > div {
        padding: 10px 4px;
        text-align: center;
    }
    .close:after {
        content: "X";
        color: #fff;
        height: 32px;
        width: 32px;
        line-height: 32px;
        text-align: center;
        background: #d63623;
        position: absolute;
        top: 0;
        right: 0;
        transition: all 0.2s linear;
        font-family: Arial;
    }
    .close:hover {
        cursor: pointer;
    }
    .close:hover:after {
        background: #ff311a;
        transition: all 0.2s linear;
    }
    .active {
        -webkit-transform: translate(-50%, -50%) scale(1);
        transition: all 0.3s ease-out;
        opacity: 1;
        z-index: 10;
    }

</style>
