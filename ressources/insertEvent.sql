SELECT * FROM calendar.events;


INSERT INTO `calendar`.`events`
(`id`,
`date_from`,
`date_to`,
`libelle`,
`calendar_fk`,
`fk_proprietaire`)
VALUES
(
UUID(), '2016-05-01 10:10', '2016-06-01 10:32:23', 'Un premier event', '400278e2-394b-11e6-9493-786fc796993c', '1');
