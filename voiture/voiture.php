<?php

class voiture {
    
    public function rouler() 
    {
        if(isset($_POST['submit']))
        $kilometre = $kilometre + 100000;
    }
    public $name = 'Audi';
    public $modele ='A4';
    public $color = 'champagne';
    public $kilometre = 100000;
    public $weight = 1800;
    public $immatriculation = "1 HPJ 790";
    public $paysbe = "Belgique";
    public $paysfr ="France";
    public $paysde ="Allemagne";
    public $datecirculation ="2002";

    public function __construct($name, $modele, $color, $kilometre, $weight, $immatriculation, $paysbe, $paysfr, $paysde, $datecirculation)
    {

    }
        public function name() 
        {
            $name = "Audi";
            echo "Ma voiture est une ".$this->name;
            echo "</br>";
        }

        public function modele() 
        {
            $modele = "A4";
            echo "Mon Audi est une ".$this->modele . " " . "de color" . " " .$this->color;
            echo "</br>";
        }

        public function kilometre()
        { 
            $kilometre =350000;
            echo "Elle a ".$this->kilometre . " " . "kilometre :" . " ";

            if($this->kilometre > 200000) 
            {
                echo "High";
            }
            elseif($this->kilometre > 10000) 
            {
                echo "Middle";
            }
            else 
            {
                echo "Low";
            }
                echo "</br>";
        }
        public function weight() 
        {
            $weight =1800;
            echo "Elle pèse". " " .$this->weight . " " . " Kg, donc c'est une voiture ";
            if($this->weight > 3500) 
            {
                echo "utilitaire";
            }
            else
            {
                echo "commerciale";
            }
            echo "</br>";
        }
        public function immatriculation() 
        {
            echo "Son immatriculation est ".$this->immatriculation . " " . "et elle provient de". " " .$this->paysbe;
            echo "</br>";
        }
        public function datecirculation() 
        {
            echo "Elle a été mise en circulation en ".$this->datecirculation . " " . "donc elle circule depuis". " " .$this->date;
        }
}
?>

<html>
    <form method="POST" action="home.php">
        <input type="submit" value="Rouler"/>
    </form>
</html>





