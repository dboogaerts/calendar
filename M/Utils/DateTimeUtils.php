<?php

namespace M\Utils;

class DateTimeUtils {
    /**
     * 
     * @param \DateTime $d
     * @return \DateTime
     */
    static public function getFirstDateTimeOfMonth(\DateTime $d) {
        $datedeb = new \DateTime($d->format("Y")."-".$d->format("M")."-01");
        return $datedeb;
    }
    /**
     * 
     * @param \DateTime $d
     * @return \DateTime
     */
    static public function getLastDateTimeOfMonth(\DateTime $d) {
        $date = self::getFirstDateTimeOfMonth($d);
        $date->add(new \DateInterval("P1M"))->sub(new \DateInterval("P1D"));
        return $date;
    }
    
    /**
     * 
     * @param \DateTime $d
     * @return \DateTime
     */
    static public function getFirstDateTimeOfWeek(\DateTime $d) {
        $jour = $d->format("N");
        $datedeb = new \DateTime($d->format("Y-m-d"));
        $datedeb->sub(new \DateInterval("P".($jour-1)."D"));
        return $datedeb;
    }
    
    /**
     * 
     * @param \DateTime $d
     * @return \DateTime
     */
    static public function getLastDateTimeOfWeek(\DateTime $d) {
        $date = self::getFirstDateTimeOfWeek($d);
        $date->add(new \DateInterval("P6D"));
        return $date;
    }
}
