<?php
// This is a very basic code for a login and password system using OOP.
// The email and password values that are declared inside the Logar() class can be retrieved from a DB.
// We added a filter in the email to remove unwanted characters using the PHP filter_var() function.

class Login {

    private $email;
    private $senha;

    public function getEmail(){
        return $this->email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setEmail($e){

        //Sanitize Email
        $email = filter_var($e, FILTER_SANITIZE_EMAIL);        
        $this->email = $email;
    }

    public function setSenha($s){
        $this->senha = $s;
    }

    public function Logar() {

        if ($this->email == "teste@teste.com" AND $this->senha == "123456"):
            echo "Successfully Logged In!";
        else:
            echo "Invalid data.";
        endif;        
    }
}

$logar = new Login();
//Take this data from a form.
$logar->setEmail("teste()/@teste.com");
$logar->setSenha("123456");
$logar->Logar();

//Use get() like this
echo"<br>The value of the email field is = " . $logar->getEmail();

?>