<?php
// ini_set('display_errors','on');
// error_reporting(E_ALL);

//$annee = date("Y");

class voiture {
    
    public function rouler() {
        if(isset($_POST['submit']))
        $kilometre = $kilometre + 100000;
    }
    
    public $nom = 'Audi';
    public $modele ='A4';
    public $couleur = 'champagne';
    public $kilometre = 100000;
    public $poid = 1800;
    public $immatriculation = "1 HPJ 790";
    public $paysbe = "Belgique";
    public $paysfr ="France";
    public $paysde ="Allemagne";
    public $datecirculation ="2002";


    public function __construct($nom, $modele, $couleur, $kilometre, $poid, $immatriculation, $paysbe, $paysfr, $paysde, $datecirculation){

        // $this->nom = ucfirst($nom);
        // $this->modele = $modele;
        // $this->couleur = $couleur;
        // $this->kilometre = $kilometre;
        // $this->poid = $poid;
        // $this->immatriculation = $immatriculation;
        // $this->paysbe = $paysbe;
        // $this->paysfr = $paysfr;
        // $this->paysde = $paysde;
        // $this->datecirculation = $datecirculation;
    }

        public function nom() {
            $nom = "Audi";
            echo "Ma voiture est une ".$this->nom;
            echo "</br>";
        }

        public function modele() {
            // function couleur(){
            //     $couleur ="champagne";
            // }
            $modele = "A4";
            echo "Mon Audi est une ".$this->modele . " " . "de couleur" . " " .$this->couleur;
            echo "</br>";
        }

        public function kilometre(){ 
            $kilometre =350000;
            echo "Elle a ".$this->kilometre . " " . "kilometre :" . " ";

            if($this->kilometre > 200000) {
                echo "High";
            }
            elseif($this->kilometre > 10000) {
                echo "Middle";
            }
            else {
                echo "Low";
            }
            
                echo "</br>";
        }
        
        public function poid() {
            $poid =1800;
            echo "Elle pèse". " " .$this->poid . " " . " Kg, donc c'est une voiture ";
            if($this->poid > 3500) {
                echo "utilitaire";
            }
            else{
                echo "commerciale";
            }
            echo "</br>";
        }

        public function immatriculation() {
            echo "Son immatriculation est ".$this->immatriculation . " " . "et elle provient de". " " .$this->paysbe;
            echo "</br>";
        }

        public function datecirculation() {
            //$date = $annee - $datecirculation;
            echo "Elle a été mise en circulation en ".$this->datecirculation . " " . "donc elle circule depuis". " " .$this->date;
        }

}
?>

<html>
    <form method="POST" action="home.php">
        <input type="submit" value="Rouler"/>
    </form>
</html>





