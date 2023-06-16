<?PHP
// Exemplo para utilização do webservice do BACEN.
//
// Instanciar a classe BACEN e utilizar a função getUltimoValorXML para a última cotação ou getValor para
// cotação em uma data especifica.
//
// Lembrando que o código para o dólar é 1.
//
// Create by Guilherme Nascimento e Leo Nogueira



class SOAP extends SOAPClient {

private static $bacen_instance;

private function SOAP($bacen_url) {
    return parent::__construct($bacen_url, array('soap_version' => SOAP_1_1));
}

public static function getInstance($bacen_dados) {
    if (empty(self::$bacen_instance))
        self::$bacen_instance = new SOAP($bacen_dados);

    return self::$bacen_instance;
}

public function call($teste, $bacen_configuracoes) {
    return parent::__soapCall($teste, $bacen_configuracoes);
}

}


class BACEN {
private $bacen_url = "https://www3.bcb.gov.br/sgspub/JSP/sgsgeral/FachadaWSSGS.wsdl";

/**
 *Função para acessar soap
 * @access public
 * @param array contendo os itens necessários para o retorno do webservice
 * @return objeto XML 
 */
public function soap($teste, $bacen_conf){
    $bacen_cliente = SOAP::getInstance($this->bacen_url);

    $bacen_resultado = $bacen_cliente->call($teste, $bacen_conf);
    return ($bacen_resultado);        
}   

/**
 *

 */
public function getUltimoValorXML($bacen_cod_moeda) {
    $bacen_conf[0] = 'getUltimoValorXML';
    $bacen_conf[1] = array('in0' => $bacen_cod_moeda);
    return $this->soap($bacen_conf);
}

   /**
 *

 */
public function getValor($bacen_cod_moeda, $databr) {
    $bacen_conf['in0'] = $bacen_cod_moeda;
    $bacen_conf['in1'] = $databr;
    $retorno = $this->soap('getValor', $bacen_conf);
    return $retorno;
}
