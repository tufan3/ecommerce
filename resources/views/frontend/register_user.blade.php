<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        /* Reset some default styles */
body, html {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    background-color: #f7f7f7;
}

.form-container {
    width: 50%;
    max-width: 400px;
    background-color: white;
    padding: 40px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    margin-right: 20px;
}

.form-container h2 {
    margin-bottom: 20px;
    font-size: 28px;
}

.input-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    border-bottom: 1px solid #ccc;
}

.input-group label {
    margin-right: 10px;
    color: #555;
}

.input-group input {
    width: 100%;
    padding: 10px 5px;
    border: none;
    outline: none;
    font-size: 16px;
    color: #333;
}

.checkbox-group {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.checkbox-group label {
    margin-left: 5px;
    font-size: 14px;
}

.checkbox-group a {
    color: #007bff;
    text-decoration: none;
}

.checkbox-group a:hover {
    text-decoration: underline;
}

.register-btn {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    margin-bottom: 15px;
}

.register-btn:hover {
    background-color: #0056b3;
}

.already-member {
    font-size: 14px;
    color: #777;
    text-align: center;
    margin-top: 10px;
}

.image-container {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-container img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Sign up</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group">
                    <label for="name"><i class="fas fa-user"></i></label>
                    {{-- <input type="text" id="name" placeholder="Your Name" required> --}}
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your Name">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="email"><i class="fas fa-envelope"></i></label>
                    {{-- <input type="email" id="email" placeholder="Your Email" required> --}}
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Your Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i></label>
                    {{-- <input type="password" id="password" placeholder="Password" required> --}}

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="confirm-password"><i class="fas fa-lock"></i></label>
                    {{-- <input type="password" id="confirm-password" placeholder="Repeat your password" required> --}}

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password">
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree all statements in <a href="#">Terms of service</a></label>
                </div>
                <button type="submit" class="register-btn">Register</button>
                <p class="already-member">I am already member</p>
            </form>
        </div>
        <div class="image-container">
            <img src="{{ asset('public/frontend') }}/images/signup_image.jpg" alt="Sign Up Illustration">
        </div>
    </div>
</body>
</html>
