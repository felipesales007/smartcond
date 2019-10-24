<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
    </head>
    <body>
        <style>
            @media only screen and (max-width: 600px) {
                .inner-body {
                    width: 100% !important;
                }
            }
        </style>

        <table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <table class="content" width="100%" cellpadding="0" cellspacing="0">
                    {{ $header ?? '' }}

                        <!-- Email Body -->
                        <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0">
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <!-- Body content -->
                                    <tr>
                                        <td class="content-cell linha-dark">
                                            @auth()
                                                <img src="{{ public_path('images/default/mailto.png') }}" width="100px" alt="">
                                                <span class="email-auto">
                                                    <b>e-mail automático, favor não responder</b>
                                                </span>
                                            @endauth

                                            @guest()
                                                <img src="{{ public_path('images/default/mailto.png') }}" width="100px" alt="">
                                                <span class="email-auto">
                                                    <b>e-mail automático, favor não responder</b>
                                                </span>
                                            @endguest
                                            <br><br><br>

                                            {{ Illuminate\Mail\Markdown::parse($slot) }}

                                            {{ $subcopy ?? '' }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        {{ $footer ?? '' }}
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
