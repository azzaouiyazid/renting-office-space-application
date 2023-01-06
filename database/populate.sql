
--
-- Dumping data for table `space`
--

INSERT INTO `space` (`sid`, `name`, `location`, `price`, `description`, `ownerusername`, `photo`, `score`) VALUES
(17, 'A test space', 'toronto', 600, 'It''s just a test, tbh', 'test', 'ipanema.jpg', 0),
(19, '80s Spaceship', 'The Galaxy', 1000, 'I''m hooked on a feeling', 'starlord', 'also me.jpg', 0);

-- --------------------------------------------------------

-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `first`, `last`, `age`, `occupation`, `photo`, `description`, `email`, `location`, `avescore`) VALUES
('Batman', 'gotham', 'Bruce', 'Wayne', NULL, NULL, NULL, NULL, 'batman@batcave.com', NULL, NULL),
('starlord', 'galaxy', 'Peter', 'Quill', 33, 'Legendary Outlaw', 'starlord.png', 'I have pelvic sorcery', 'starlord@galaxy.com', 'Space', NULL),
('test', 'test', 'Test', 'Testest', 21, 'Tester', 'clazzi cover.jpg', 'I am testing', 'test@test.ca', 'Toronto', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friendswith`
--
ALTER TABLE `friendswith`
 ADD KEY `pid1` (`username1`,`username2`,`sid`), ADD KEY `pid2` (`username2`,`sid`), ADD KEY `sid` (`sid`);

--
-- Indexes for table `interestedin`
--
ALTER TABLE `interestedin`
 ADD KEY `pid` (`username`), ADD KEY `sid` (`sid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`username`,`sid`), ADD KEY `pid` (`username`,`sid`), ADD KEY `sid` (`sid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
 ADD PRIMARY KEY (`rid`), ADD KEY `reviewerid` (`reviewerusername`,`ownerusername`), ADD KEY `reviewedid` (`ownerusername`), ADD KEY `sid` (`sid`);

--
-- Indexes for table `skilledin`
--
ALTER TABLE `skilledin`
 ADD KEY `pid` (`username`), ADD KEY `pid_2` (`username`);

--
-- Indexes for table `space`
--
ALTER TABLE `space`
 ADD PRIMARY KEY (`sid`), ADD KEY `ownerid` (`ownerusername`), ADD KEY `ownerid_2` (`ownerusername`), ADD KEY `sid` (`sid`), ADD KEY `sid_2` (`sid`), ADD KEY `sid_3` (`sid`);

--
-- Indexes for table `spaceprojects`
--
ALTER TABLE `spaceprojects`
 ADD KEY `sid` (`sid`);

--
-- Indexes for table `userreview`
--
ALTER TABLE `userreview`
 ADD PRIMARY KEY (`urid`), ADD KEY `reviewerusername` (`reviewerusername`,`reviewedusername`), ADD KEY `reviewedusername` (`reviewedusername`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`username`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD KEY `pid` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `space`
--
ALTER TABLE `space`
MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `userreview`
--
ALTER TABLE `userreview`
MODIFY `urid` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friendswith`
--
ALTER TABLE `friendswith`
ADD CONSTRAINT `friendswith_ibfk_3` FOREIGN KEY (`sid`) REFERENCES `space` (`sid`),
ADD CONSTRAINT `friendswith_ibfk_4` FOREIGN KEY (`username1`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `friendswith_ibfk_5` FOREIGN KEY (`username2`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interestedin`
--
ALTER TABLE `interestedin`
ADD CONSTRAINT `interestedin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `interestedin_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `space` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
ADD CONSTRAINT `members_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `space` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `members_ibfk_3` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`reviewerusername`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`ownerusername`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`sid`) REFERENCES `space` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skilledin`
--
ALTER TABLE `skilledin`
ADD CONSTRAINT `skilledin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `space`
--
ALTER TABLE `space`
ADD CONSTRAINT `space_ibfk_1` FOREIGN KEY (`ownerusername`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spaceprojects`
--
ALTER TABLE `spaceprojects`
ADD CONSTRAINT `spaceprojects_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `space` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userreview`
--
ALTER TABLE `userreview`
ADD CONSTRAINT `userreview_ibfk_1` FOREIGN KEY (`reviewerusername`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `userreview_ibfk_2` FOREIGN KEY (`reviewedusername`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;