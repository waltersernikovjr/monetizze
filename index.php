
<?php
class Loteria
{

    protected $Resultado;
    protected $Jogos;
    protected $QuantidadeDezenas;
    protected $TotalJogos;


    public function getJogos()
    {
        return $this->Jogos;
    }

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function setJogos($jogos)
    {
        $this->Jogos = $jogos;
    }

    public function setResultado($resultado)
    {
        $this->Resultado = $resultado;
    }
}

class JogosLoteria extends Loteria
{

    public function __construct($QuantidadeDezenas, $TotalJogos)
    {



        //Não usei >=6 && <=9 para não aceitar numeros decimais
        if ($QuantidadeDezenas == 6 || $QuantidadeDezenas == 7 || $QuantidadeDezenas == 8 || $QuantidadeDezenas == 9 || $QuantidadeDezenas == 10) {

            $this->QuantidadeDezenas = $QuantidadeDezenas;
            $this->TotalJogos = $TotalJogos;
            $this->Jogos = array();

        } else {
            throw new Exception("Numero de dezenas informado é inválido");
        }

    }


    public function todosJogos()
    {
        $todosJogos = array();
        for ($c = 0; $c < $this->TotalJogos; $c++) {
            $todosJogos[] = $this->sortearJogo();
        }

        $this->setJogos($todosJogos);
    }


    private function sortearJogo()
    {
        $this->Resultado = array();
        for ($c = 0; $c < $this->QuantidadeDezenas; $c++) {
            $achou = 0;
            while ($achou == 0) {
                $numero = rand(1, 60);
                if (in_array($numero, $this->Resultado) == false) {
                    $this->Resultado[] = $numero;
                    $achou = 1;
                }
            }
        }

        sort($this->Resultado);

        return $this->Resultado;
    }

    public function sotearJogo6()
    {
        $this->Resultado = array();
        for ($c = 0; $c < 6; $c++) {
            $achou = 0;
            while ($achou == 0) {
                $numero = rand(1, 60);
                if (in_array($numero, $this->Resultado) == false) {
                    $this->Resultado[] = $numero;
                    $achou = 1;
                }
            }
        }

        sort($this->Resultado);

        $this->Jogos[] = $this->Resultado;
    }

    public function retornaTabelaHTML()
    {
        $tabela = "<table>";
        $tabela .= "<thead><tr><th>Dezenas</th><th>Numeros Sorteados</th></tr></thead>";
        foreach ($this->Jogos as $jogo) {
            $tabela .= "<tr>";
            $tabela .= "<td>" . count($jogo) . "</td>";
            $tabela .= "<td>" . implode(', ', $jogo) . "</td>";
            $tabela .= "</tr>";
        }

        $tabela .= "</table>";

        return $tabela;
    }
}



try {
    $jogo = new JogosLoteria(8, 3);

    $jogo->todosJogos();
    $jogo->sotearJogo6();

    echo $jogo->retornaTabelaHTML();

} catch (Exception $e) {

    echo "Erro: ".$e->getMessage();

}
