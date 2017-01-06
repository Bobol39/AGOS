TRUNCATE `agos`.`professeur`;
TRUNCATE `agos`.`salle`;
TRUNCATE `agos`.`promotion`;
TRUNCATE `agos`.`critere`;
TRUNCATE `agos`.`groupe_notation`;
TRUNCATE `agos`.`critere_groupe_notation_jonction`;
TRUNCATE `agos`.`planning`;

INSERT INTO `agos`.`professeur` (`id`, `nom`, `prenom`, `abreviation`) VALUES
('jccharr', 'Charr', 'Jean-Claude', 'jcc'),
('jfcouchot', 'Couchot', 'Jean-François', 'jfc'),
('icouturier', 'Couturier', 'Ingrid', 'ico'),
('rcouturier', 'Couturier', 'Raphaël', 'rco'),
('kdeschinkel', 'Deschinkel', 'Karine', 'kde'),
('sdomas', 'Domas', 'Stéphane', 'sdo'),
('fmiloud', 'Fouzi', 'miloud', 'mfo'),
('agiersch', 'Giersch', 'Arnaud', 'agi'),
('cguyeux', 'Guyeux', 'Christophe', 'cgu'),
('mhakem', 'Hakem', 'Mourad', 'mha'),
('pcheam', 'Heam', 'Pierre-Cyrille', 'pch'),
('dlaiymani', 'Laiymani', 'David', 'dla'),
('amakhoul', 'Makhoul', 'Abdallah', 'ama'),
('amillet', 'Millet', 'Alain', 'ami'),
('cpaterlini', 'Paterlini', 'Corinne', 'cpa'),
('gperrot', 'Perrot', 'Gilles', 'gpe'),
('smichel', 'Salomon', 'Michel', 'msa');

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
  (5, 'LP TeProW');

INSERT INTO `agos`.`critere` (`id`, `titre`) VALUES
  (1, 'Mise en avant des principales fonctionnalités'),
  (2, 'Demonstration des fonctionnalités'),
  (3, 'Forme');


INSERT INTO `agos`.`groupe_notation` (`id`, `titre`) VALUES
  (1, 'Critères 1ere année'),
  (2, 'Critères 2nd année'),
  (3, 'Critères TeProW');

INSERT INTO `agos`.`critere_groupe_notation_jonction` (`id`, `id_critere`, `id_groupe_notation`, `bareme`) VALUES
  (1, 1, 3, 10),
  (2, 2,3, 5),
  (3, 3,3, 5);

INSERT INTO `agos`.`etudiant` (`id`, `nom`, `prenom`,`id_promotion`) VALUES
  ('ajossic', 'Jossic', 'Alfred',5),
  ('cbolard', 'Bolard', 'Clement',5),
  ('ihajali', 'Ilyes', 'Haj Ali',5),
  ('mmenegain', 'Mathieu', 'Menegain',5),
  ('jduguet', 'Jerôme', 'Duguet',5),
  ('pvirlois', 'Peter', 'Virlois',5),
  ('tlehmann', 'Thomas', 'Lehmann',5),
  ('cdegrelle', 'Cedric', 'Degrelle',5),
  ('pnom4', 'Nom4', 'Prenom4',4),
  ('pnom5', 'Nom5', 'Prenom5',4),
  ('pnom6', 'Nom6', 'Prenom6',4),
  ('pnom7', 'Nom7', 'Prenom7',3),
  ('pnom8', 'Nom8', 'Prenom8',3),
  ('pnom9', 'Nom9', 'Prenom9',3),
  ('pnom10', 'Nom10', 'Prenom10',2),
  ('pnom11', 'Nom11', 'Prenom11',2),
  ('pnom12', 'Nom12', 'Prenom12',2),
  ('pnom13', 'Nom13', 'Prenom13',1),
  ('pnom14', 'Nom14', 'Prenom14',1),
  ('pnom15', 'Nom15', 'Prenom15',1);