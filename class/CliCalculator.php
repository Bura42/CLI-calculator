<?php

// @ CLI Calculator Class

class CliCalculator
{
    /**
     * const e
     */
    const e = 2.71;

    /**
     *const Pi
     */
    const Pi = 3.14;

    /**
     * @var string
     */
    protected $tmpVarName;

    /**
     * @var string
     */
    protected $tmpVarValue;


    /**
     * CliCalculator constructor.
     */
    public function __construct()
    {
        $this->tmpVarName = '';
        $this->tmpVarValue = '';
    }

    /**
     * @param $a
     * @return float|int|string
     */
    protected function numVariable($a) {

        switch (preg_replace('/\s+/', '', $a)) {
            case 'pi':
                $a = self::Pi;
                break;
            case 'e':
                $a = self::e;
                break;
            case strpos($a, '=') == true:
                $str = explode("=", preg_replace('/\s+/', '', $a));
                $this->tmpVarName = $str[0];
                $this->tmpVarValue = $str[1];
                $a = 0;
                break;
            case $this->tmpVarName:
                $a = $this->tmpVarValue;
                break;
        }

        return $a;
    }

    /**
     * @param $operation
     */
    private function helpInfo($operation) {
        echo "You can create you own variable \n";
        echo "Type variableName=variableValue\n";
        echo "Then type variable value to expression\n";
        echo 'For '.$operation."\n";
        echo 'Enter first number: ';
    }

    /**
     * @return bool|string
     */
    private function cliReader(){
        $handle = fopen('php://stdin', 'r');
        $a = fgets($handle);
        $a = strtolower(trim($a));
        fclose($handle);
        return $a;
    }

    /**
     * addition
     */
    public function add()
    {
        (int) $sum = 0;
        (int) $tNum = 0;
        $this->helpInfo('addition');
        $a = $this->cliReader();
        while ($a != 'cal') {
            $sum = $sum + $this->numVariable($a);
            $tNum++;
            echo 'Enter another number enter "cal" to calculate ';
            $a = $this->cliReader();
        }

        echo 'Total number you enter: '.$tNum."\n";
        echo 'Sum is: '.$sum."\n";
        $this->main();
    }

    /**
     * average
     */
    public function avg()
    {
        (int) $aTotal = 0;
        (int) $tNum = 0;
        $this->helpInfo('average');
        $a = $this->cliReader();
        while ($a != 'cal') {
            $aTotal = $aTotal + $this->numVariable($a);
            $tNum++;
            echo 'Enter another number enter "cal" to calculate ';
            $a = $this->cliReader();
        }
        echo 'Total number you enter: '.$tNum."\n";
        echo 'Average is: '.$aTotal."\n";
        $this->main();
    }

    /**
     * Multiplication
     */
    public function mul()
    {
        (int) $mul = 1;
        (int) $tNum = 0;
        $this->helpInfo('Multiplication');
        $a = $this->cliReader();
        while ($a != 'cal') {
            $mul = $mul * $this->numVariable($a);
            $tNum++;
            echo 'Enter another number enter "cal" to calculate ';
            $a = $this->cliReader();
        }
        echo 'Total number you enter: '.$tNum."\n";
        echo 'Multiply is: '.$mul."\n";
        $this->main();
    }

    /**
     * Subtraction
     */
    public function sub()
    {
        $this->helpInfo('Subtraction');
        $a = $this->cliReader();
        echo "\n Enter 2nd number: ";
        $b = $this->cliReader();
        $sub = $this->numVariable($a) - $this->numVariable($b);
        echo 'Subtraction of '.$a.' - '.$b.' = '.$sub."\n";
        $this->main();
    }

    /**
     * Division
     */
    public function div()
    {
        $this->helpInfo('Division');
        $a = $this->cliReader();
        echo "\n Enter 2nd number: ";
        $b = $this->cliReader();
        $div = $this->numVariable($a) / $this->numVariable($b);
        echo 'Division of '.$a.' / '.$b.' = '.$div."\n";
        $this->main();
    }

    /**
     * Reaminder
     */
    public function rem()
    {
        $this->helpInfo('Reaminder');
        $a = $this->cliReader();
        echo "\n Enter 2nd number: ";
        $b = $this->cliReader();
        $rem = $this->numVariable($a) % $this->numVariable($b);
        echo 'Reaminder of '.$a.' % '.$b.' = '.$rem."\n";
        $this->main();
    }

    /**
     * Percentage
     */
    public function per()
    {
        $this->helpInfo('Percentage');
        $a = $this->cliReader();
        echo "\n Enter 2nd number: ";
        $b = $this->cliReader();
        $per = 100 * $this->numVariable($a) / $this->numVariable($b);
        echo 'Percentage is '.$per."\n";
        $this->main();
    }

    /**
     * Main menu function
     */
    public function main()
    {
        do {
            echo " CLI Calculator in PHP \n";
            echo " ***************************** \n";
            echo " For addition enter 'a' \n";
            echo " For substraction enter 's' \n";
            echo " For division enter 'd' \n";
            echo " For multiplication enter 'm' \n";
            echo " For average enter 'v' \n";
            echo " For percentage enter 'p' \n";
            echo " For reaminder enter 'e' \n";
            echo " ***************************** \n";
            $handle = fopen('php://stdin', 'r');
            $x = fgets($handle);
            $x = strtolower(trim($x));
            fclose($handle);
            if ($x === 'a') {
                $this->add();
            } elseif ($x === 's') {
                $this->sub();
            } elseif ($x === 'd') {
                $this->div();
            } elseif ($x === 'm') {
                $this->mul();
            } elseif ($x === 'v') {
                $this->avg();
            } elseif ($x === 'p') {
                $this->per();
            } elseif ($x === 'e') {
                $this->rem();
            } else {
                $this->main();
            }
            echo "Enter 'r' to repeat";
        } while ($x === 'r');
    }

    /**
     * run function
     */
    public function run()
    {
        $this->main();
    }
}
