<?php

class HareNiemeier
{
    protected $_parties;
    protected $_votes;

    public function setParties(array $parties)
    {
        if(!count($parties)) {
            throw new Exception('Number of parties is not valid.');
        }
        $this->_parties = $parties;
    }
    public function setVotesToParties($votes)
    {
        if(!count($this->_parties)) {
            throw new Exception('Set parties first.');
        }
        if(count($this->_parties) != count($votes)) {
            throw new Exception('Count votes != count parties.');
        }
        $this->_votes = $votes;
    }
    public function calculate($seats)
    {
        if(!is_int($seats)) {
            throw new Exception('Number of seats is not valid.');
        }
        $sumVotes = array_sum($this->_votes);

        $calc = function (&$val) use ($sumVotes, $seats){
            return ($val * $seats) / $sumVotes;
        };
        $firstStep= array_map($calc, $this->_votes);
        $getCeil = function ($partyFirstStep) {
            return floor($partyFirstStep);
        };
        $getFractional = function ($partyFirstStep) {
            return $partyFirstStep - floor($partyFirstStep);
        };
        $ceils = array_map($getCeil, $firstStep);
        $fractional = array_map($getFractional, $firstStep);
        $leftSeats = $seats - array_sum($ceils);
        if ($leftSeats) {
            arsort($fractional);
            foreach ($fractional as $key => $val) {
                $ceils[$key]++;
                $leftSeats--;
                if ($leftSeats == 0) {
                    break;
                }
            }
        }
        return $ceils;
    }
}

$t = new HareNiemeier();
$t->setParties(array('a', 'b', 'c', 'd'));
$t->setVotesToParties(array(15000, 5400, 5500, 5550));
var_dump($t->calculate(15));


