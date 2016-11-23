TRUNCATE `agos`.`professeur`;
TRUNCATE `agos`.`salle`;
TRUNCATE `agos`.`promotion`;
TRUNCATE `agos`.`critere`;
TRUNCATE `agos`.`groupe_notation`;
TRUNCATE `agos`.`critere_groupe_notation_jonction`;
TRUNCATE `agos`.`planning`;

INSERT INTO `agos`.`professeur` (`id`, `nom`, `prenom`, `abreviation`) VALUES
('jccharr', 'Charr', 'Jean-Claude', 'jccharr'),
('jfcouchot', 'Couchot', 'Jean-François', 'jfcouchot'),
('icouturier', 'Couturier', 'Ingrid', 'icouturier'),
('rcouturier', 'Couturier', 'Raphaël', 'rcouturier'),
('kdeschinkel', 'Deschinkel', 'Karine', 'kdeschinkel'),
('sdomas', 'Domas', 'Stéphane', 'sdomas'),
('fmiloud', 'Fouzi', 'miloud', 'fmiloud'),
('agiersch', 'Giersch', 'Arnaud', 'agiersch'),
('cguyeux', 'Guyeux', 'Christophe', 'cguyeux'),
('mhakem', 'Hakem', 'Mourad', 'mhakem'),
('pcheam', 'Heam', 'Pierre-Cyrille', 'pcheam'),
('pjacquin', 'Jacquin', 'Patrick', 'pjacquin'),
('dlaiymani', 'Laiymani', 'David', 'dlaiymani'),
('amakhoul', 'Makhoul', 'Abdallah', 'amakhoul'),
('amillet', 'Millet', 'Alain', 'amillet'),
('cpaterlini', 'Paterlini', 'Corinne', 'cpaterlini'),
('gperrot', 'Perrot', 'Gilles', 'gperrot'),
('tsahler', 'Sahler', 'Thierry', 'tsahler'),
('smichel', 'Salomon', 'Michel', 'smichel');

INSERT INTO `agos`.`salle` (`id`, `nom`) VALUES
('208', '208'),
('207', '207'),
('206', '206'),
('205', '205'),
('204', '204'),
('203', '203'),
('202', '202'),
('201', '201'),
('108', '108'),
('107', '107'),
('106', '106'),
('105', '105'),
('104', '104'),
('103', '103'),
('102', '102'),
('101', '101'),
('LP', 'LP');

INSERT INTO `agos`.`promotion` (`id`, `nom`) VALUES
  (1, 's1'),
  (2, 's2'),
  (3, 's3'),
  (4, 's4'),
  (5, 's5'),
  (6, 'LP TeProW');

INSERT INTO `agos`.`critere` (`id`, `titre`) VALUES
  (1, 'crit1'),
  (2, 'crit2'),
  (3, 'crit3');


INSERT INTO `agos`.`groupe_notation` (`id`, `titre`) VALUES
  (1, 'group1'),
  (2, 'group2'),
  (3, 'group3');

INSERT INTO `agos`.`critere_groupe_notation_jonction` (`id`, `id_critere`, `id_groupe_notation`, `bareme`) VALUES
  (1, 1, 1, 0),
  (2, 2,1, 2.0),
  (3, 2,1, 1.0);

INSERT INTO `agos`.`etudiant` (`id`, `nom`, `prenom`,`id_promotion`) VALUES
  (1, 'Jossic', 'Alfred',6),
  (2, 'Bolard', 'Clement',6),
  (3, 'Ilyes', 'Haj-Ali-G',6),
  (4, 'Nom1', 'Prenom1',5),
  (5, 'Nom2', 'Prenom2',5),
  (6, 'Nom3', 'Prenom3',5),
  (7, 'Nom4', 'Prenom4',4),
  (8, 'Nom5', 'Prenom5',4),
  (9, 'Nom6', 'Prenom6',4),
  (10, 'Nom7', 'Prenom7',3),
  (11, 'Nom8', 'Prenom8',3),
  (12, 'Nom9', 'Prenom9',3),
  (13, 'Nom10', 'Prenom10',2),
  (14, 'Nom11', 'Prenom11',2),
  (15, 'Nom12', 'Prenom12',2),
  (16, 'Nom13', 'Prenom13',1),
  (17, 'Nom14', 'Prenom14',1),
  (18, 'Nom15', 'Prenom15',1);