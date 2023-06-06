<?

function protect( $str ) {
  /*** Função para retornar uma string/Array protegidos contra SQL/Blind/XSS Injection*/
     if( !is_array( $str ) ) {                      
             $str = preg_replace( '/(from|select|insert|delete|where|drop|union|order|update|database)/i', '', $str );
             $str = preg_replace( '/(&lt;|<)?script(\/?(&gt;|>(.*))?)/i', '', $str );
             $tbl = get_html_translation_table( HTML_ENTITIES );
             $tbl = array_flip( $tbl );
             $str = addslashes( $str );
             $str = strip_tags( $str );
             return strtr( $str, $tbl );
     } else {
             return array_filter( $str, "protect" );
     }
 }

function formatCnpjCpf($value) {
   $CPF_LENGTH = 11;
   $cnpj_cpf = preg_replace("/\D/", '', $value);
   
   if (strlen($cnpj_cpf) === $CPF_LENGTH) {
     return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
   } 
   
   return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
 }

function formatPhone($numero) {
    if(strlen($numero) == 10){
        $novo = substr_replace($numero, '(', 0, 0);
        $novo = substr_replace($novo, '9', 3, 0);
        $novo = substr_replace($novo, ')', 3, 0);
        $novo = substr_replace($novo, '-', 9, 0);
    } else {
        $novo = substr_replace($numero, '(', 0, 0);
        $novo = substr_replace($novo, ')', 3, 0);
        $novo = substr_replace($novo, '-', 9, 0);
    }
    return $novo;
}