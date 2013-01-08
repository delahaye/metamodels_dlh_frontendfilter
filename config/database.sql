-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `metamodels_dlh_frontendfilter_metamodel` int(10) unsigned NOT NULL default '0',
  `metamodels_dlh_frontendfilter_filter` int(10) unsigned NOT NULL default '0',
  `metamodels_dlh_frontendfilter_autosubmit` varchar(32) NOT NULL default '',
  `metamodels_dlh_frontendfilter_attributes` blob NULL,
  `metamodels_dlh_frontendfilter_template` varchar(32) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `metamodels_dlh_frontendfilter_metamodel` int(10) unsigned NOT NULL default '0',
  `metamodels_dlh_frontendfilter_filter` int(10) unsigned NOT NULL default '0',
  `metamodels_dlh_frontendfilter_autosubmit` varchar(32) NOT NULL default '',
  `metamodels_dlh_frontendfilter_attributes` blob NULL,
  `metamodels_dlh_frontendfilter_template` varchar(32) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_metamodel_filtersetting`
--

CREATE TABLE `tl_metamodel_filtersetting` (
  `label` varchar(64) NOT NULL default '',
  `moreequal` char(1) NOT NULL default '1',
  `lessequal` char(1) NOT NULL default '1',
  `fromfield` char(1) NOT NULL default '1',
  `tofield` char(1) NOT NULL default '1',
  `yesfield` char(1) NOT NULL default '1',
  `blankoption` char(1) NOT NULL default '1',
  `defaultid` int(10) unsigned NOT NULL default '0',
  `textsearch` varchar(32) NOT NULL default '',
  `attr_id2` int(10) unsigned NOT NULL default '0',
  `useor` char(1) NOT NULL default '0',
  `onlyused` char(1) NOT NULL default '0',
  `onlypossible` char(1) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;