TRUNCATE `agos`.`professeur`;
TRUNCATE `agos`.`salle`;

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