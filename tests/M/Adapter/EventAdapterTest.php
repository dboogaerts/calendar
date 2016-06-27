<?php

namespace M\Adapter;
require_once __DIR__.'/../../../M/Utils/PDOConnexion.php';
require_once __DIR__.'/../../../M/Adapter/EventAdapter.php';
require_once __DIR__."/../../../M/Utils/DateTimeUtils.php";
use M\Utils\DateTimeUtils;
/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-06-24 at 11:08:37.
 */
class EventAdapterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var EventAdapter
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new EventAdapter(\M\Utils\PDOConnexion::getInstance());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers M\Adapter\EventAdapter::getCalendar
     * @todo   Implement testGetCalendar().
     */
    public function testGetCalendar() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers M\Adapter\EventAdapter::getCalendarByMonth
     * @todo   Implement testGetCalendarByMonth().
     */
    public function testGetCalendarByMonth() {
        $e = $this->object->getCalendarByMonth();
        foreach ($e->getEvents() as $value) {            
            $this-> assertTrue(
                    $value->getDateFrom()<=DateTimeUtils::getLastDateTimeOfMonth(new \DateTime) && $value->getDateTo()>=DateTimeUtils::getFirstDateTimeOfMonth(new \DateTime)
                    );
            
        }
    }

    /**
     * @covers M\Adapter\EventAdapter::getCalendarByWeek
     * @todo   Implement testGetCalendarByWeek().
     */
    public function testGetCalendarByWeek() {
        $e = $this->object->getCalendarByWeek();
        foreach ($e->getEvents() as $value) {            
            $this-> assertTrue(
                    $value->getDateFrom()<=DateTimeUtils::getLastDateTimeOfWeek(new \DateTime) && $value->getDateTo()>=DateTimeUtils::getfirstDateTimeOfWeek(new \DateTime)
                    );  
        }
    }

    /**
     * @covers M\Adapter\EventAdapter::getCalendarByDay
     * @todo   Implement testGetCalendarByDay().
     */
    public function testGetCalendarByDay() {
        echo "par Jour\n";
        $e = $this->object->getCalendarByDay();
        foreach ($e->getEvents() as $value) {            
            echo $value->getDateFrom()->format("d/m/Y")." au ".$value->getDateTo()->format("d/m/Y")."\n";
            $this-> assertTrue(
                    $value->getDateFrom()<=new \DateTime() && $value->getDateTo()>=(new \DateTime())->add(new \DateInterval("PT23H59M"))
                    );
        }
    }

    /**
     * @covers M\Adapter\EventAdapter::addEvent
     * @todo   Implement testAddEvent().
     */
    public function testAddEvent() {
       $e = new \M\Metier\Event();
       $c = new \M\Metier\Calendar();
       $c->popule(["id"=>'400278e2-394b-11e6-9493-786fc796993c']);
       $u = new \M\Metier\User();
       $u -> popule(["id"=>1]);
       
       $id = uniqid();
       $e->popule([
           "dateFrom"=>new \DateTime("2016-06-24 12:12"),
           "dateTo"=>new \DateTime("2016-06-28 12:12"),
           "libelle"=>"du 24 au 28 Juin",
           "calendar"=>$c,
           "proprietaire"=>$u
           
       ]);
       
       $id = $this->object->addEvents($c, $e);
       $evt =  $this->object->getCalendarByDay(new \DateTime("2016-06-27"));
       var_dump($evt);
       $this->assertArrayHasKey($id, $evt->getEvents(),"L'event inséré n'est pas récupéré");
       
    }

    /**
     * @covers M\Adapter\EventAdapter::removeEvent
     * @todo   Implement testRemoveEvent().
     */
    public function testRemoveEvent() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers M\Adapter\EventAdapter::updateEvent
     * @todo   Implement testUpdateEvent().
     */
    public function testUpdateEvent() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}
