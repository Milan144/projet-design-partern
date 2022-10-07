<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=bot-crypto", "root", "");
} catch (PDOException $e) {
    echo $e->getMessage();
}


//Singleton
Class DBConnector{

    static Connection mysql;

    public static Connection getConnection(){
        if(mysql == null){
            mysql = new MySqlInstance(
                            "localhost" ,
                            "root" ,
                            "" ,
                            "bot-crypto"
                        );
        } 
        return mysql;
    }

}
