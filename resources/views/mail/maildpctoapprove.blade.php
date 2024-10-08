<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<?php

$style = [
    'content' => 'background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;',
    'wrapper' => 'background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;',
    
    'table' => 'border-collapse:collapse',
    'td' => 'text-align:center; padding-bottom: 10px',
    'email-content' => 'text-align:center; margin:0 60px 34px 60px',
    'div-logo' => 'margin-bottom: 10px',
    'img-logo' => 'height: 35px',

    'div-text' => 'font-size: 14px; font-weight: 500; margin-bottom: 42px; font-family:Arial,Helvetica,sans-serif',
    'title-text' => 'margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700',
    'p-text' => 'margin-bottom:2px; color:#7E8299',
    'footer' => 'font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif'
];
?>

<body>
    <div id="#kt_app_body_content" style="{{ $style['content'] }}">
        <div style="{{ $style['wrapper'] }}">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto" style="{{$style['table']}}">
                <tbody>
                    <tr>
                        <td align="center" valign="center" style="{{$style['td']}}">
                            <!--begin:Email content-->
                            <div style="{{$style['email-content']}}">
                                <!--begin:Logo-->
                                <div style="{{$style['div-logo']}}">
                                    <a href="https://dpp-imm.or.id/" rel="noopener" target="_blank">
                                        <img alt="Logo" src="{{$message->embed(public_path().'/assets/media/logo-IMM.png')}}" style="{{$style['img-logo']}}">
                                    </a>
                                </div>
                                <!--end:Logo-->
                                <!--begin:Text-->
                                <div style="{{$style['div-text']}}">
                                    <p style="{{$style['title-text']}}">Assalamualaikum Warahmatullah Wabarakatuh</p>
                                    <p style="{{$style['p-text']}}">Terdapat data pengajuan yang perlu anda proses atas nama <b>{{$member_name}}</b></p>
                                    <p style="{{$style['p-text']}}">Silahkan login ke Aplikasi eKTA-IMM, proses ke menu <b>Validasi Pendaftaran</b> untuk melihat detail data pendaftaran tersebut</p><br/><br/>
                                    <p style="{{$style['p-text']}}">Terima Kasih</p>
                                </div>
                            </div>
                            <!--end:Email content-->
                        </td>
                    </tr>

                    <tr>
                        <td align="center" valign="center" style="{{$style['footer']}}">
                            <p>© Ikatan Mahasiswa Muhammadiyah.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
