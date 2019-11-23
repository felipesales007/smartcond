<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0">
            <tr>
                <td class="content-footer" align="center">
                    <br>{{ Illuminate\Mail\Markdown::parse($slot) }}
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>
        <table class="footer-info" align="justify" cellpadding="0" cellspacing="0">
            <tr>
                <td class="content-footer" align="justify">
                    {{ Illuminate\Mail\Markdown::parse('A informação transmitida destina-se apenas à pessoa ou entidade a quem foi endereçada e pode conter informação confidencial, legalmente protegida e para conhecimento exclusivo do destinatário. Se o leitor desta advertência não for o seu destinatário, fica ciente de que a sua leitura, divulgação, distribuição ou cópia é estritamente proibida. Caso a mensagem tenha sido recebida por engano, favor comunicar ao remetente e apagar o texto do computador.') }}
                </td>
            </tr>
        </table>
    </td>
</tr>
