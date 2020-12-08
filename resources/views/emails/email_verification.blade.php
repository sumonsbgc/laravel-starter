@include('emails.header')
<tr>
    <td>
        <table style="background-color: #fff; padding: 32px;width: 570px;margin: 0 auto;box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); border: 1px solid #e8e5ef;border-radius: 2px;">
            <tbody>
                <tr style="padding: 1.5rem;">
                    <td align="center">
                        <img style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden;background: #000; padding: 10px;box-sizing: border-box;" src="{{ asset('assets/admin-logo.svg') }}" alt="{{ config()->get('app.name') }}">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h1 style="font-size: 18px; text-align: left;">Welcome to {{ ucfirst(config()->get('app.name')) }} {{ $name }}</h1>
                        <p style="font-size: 16px; line-height: 1.5rem;">Please click the button below to verify your email address.</p>        
                        <a style="width: 200px; text-decoration: none; overflow: hidden; border-radius: 4px; border: 10px solid #2d3748;margin: 30px auto;background-color: #2d3748; color: #fff; padding: .2rem 2rem; text-align: center; display: block;" href="{{ $url }}">Verify Email Address</a>
                        <p style="font-size: 16px; line-height: 1.5rem; text-align: left;">If you did not create an account, no further action is required.</p>
                        <p>
                            Regards <br>
                            {{ config()->get('app.name') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="margin-top: 25px; padding-top: 25px;position: relative; border-top: 1px solid #e8e5ef;">
                        <p style="font-size: 14px; line-height: 1.5rem; text-align: left; word-break: break-all; position: relative;">
                            If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below
                            into your web browser: <a href="{{ $url }}" style="color: #3869d4;">{{ $url }}</a>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@include('emails.footer')