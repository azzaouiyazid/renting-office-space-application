
-- Database: `synergyspace`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendswith`
--

CREATE TABLE IF NOT EXISTS `friendswith` (
  `username1` varchar(16) NOT NULL,
  `username2` varchar(16) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interestedin`
--

CREATE TABLE IF NOT EXISTS `interestedin` (
  `username` varchar(16) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `username` varchar(16) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`username`, `sid`) VALUES
('Batman', 17),
('starlord', 17);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
`rid` int(11) NOT NULL,
  `reviewerusername` varchar(16) NOT NULL,
  `ownerusername` varchar(16) NOT NULL,
  `description` text NOT NULL,
  `score` int(11) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `skilledin`
--

CREATE TABLE IF NOT EXISTS `skilledin` (
  `username` varchar(16) NOT NULL,
  `skill` varchar(46) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `space`
--

CREATE TABLE IF NOT EXISTS `space` (
`sid` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `location` varchar(46) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `ownerusername` varchar(16) NOT NULL,
  `photo` varchar(16) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;


--
-- Table structure for table `spaceprojects`
--

CREATE TABLE IF NOT EXISTS `spaceprojects` (
  `sid` int(11) NOT NULL,
  `projectname` varchar(46) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userreview`
--

CREATE TABLE IF NOT EXISTS `userreview` (
`urid` int(11) NOT NULL,
  `reviewerusername` varchar(46) NOT NULL,
  `reviewedusername` varchar(46) NOT NULL,
  `description` text NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `first` varchar(46) NOT NULL,
  `last` varchar(46) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `occupation` varchar(46) DEFAULT NULL,
  `photo` varchar(16) DEFAULT NULL,
  `description` text,
  `email` varchar(46) NOT NULL,
  `location` varchar(46) DEFAULT NULL,
  `avescore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--

