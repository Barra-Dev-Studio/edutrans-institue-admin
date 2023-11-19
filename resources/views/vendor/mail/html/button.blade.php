@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;margin-bottom: 16px;">
    <tr>
        <td align="center" bgcolor="#306A98" role="presentation"
            style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px;background:#306A98;"
            valign="middle">
            <a href="{{ $url }}"
                style="display:inline-block;background:#306A98;color:#ffffff;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:5px;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:3px;">{{ $slot }}</a>
        </td>
    </tr>
</table>
