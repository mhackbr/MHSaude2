-- 
-- Estrutura da tabela `user`
-- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(200) NOT NULL default '',
  `senha` varchar(200) NOT NULL default '',
  `email` varchar(200) NOT NULL default '',
  `activo` enum('N','S') NOT NULL default 'N',
  `sessao` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Extraindo dados da tabela `user`
-- 
