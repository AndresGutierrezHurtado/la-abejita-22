<!DOCTYPE html>
<html>
<head>
    <title>Correo contacto</title>
    <style> 
        * {
        margin: 0;
        padding:0;
        }
    </style>
</head>
<body style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#edf2f7;margin:0;padding:0;width:100%">
    <div style=" max-width: 500px; margin: 50px auto; text-align:center;">
        <h2 style="margin-bottom: 20px; margin-top:20px;">Uniformes la abejita 22</h2>
        <div style="background-color: white; padding: 10px 20px; margin: 0;">
          <h1>Formulario contacto</h1>
        </div>
        <hr>
        <div style="background-color: white; padding: 20px;">
          <h2>{{ $details['title'] }}</h2>
          <p style="margin-bottom: 10px">{{ $details['body'] }}</p>
          <p>Enviado por: {{ $details['user_full_name'] }} ({{ $details['user_email'] }})</p>
        </div>
        <p style="margin-top: 20px; margin-bottom:20px; color: #b0adc5;">© 2024 Uniformes la Abejita 22. All rights reserved.</p>
    </div>
</body>
</html>
