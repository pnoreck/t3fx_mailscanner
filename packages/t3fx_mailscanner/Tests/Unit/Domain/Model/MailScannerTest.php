<?php

namespace T3fx\T3fxMailscanner\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Steffen Hastädt <mailscanner@t3x.ch>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \T3fx\T3fxMailscanner\Domain\Model\MailScanner.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Steffen Hastädt <mailscanner@t3x.ch>
 */
class MailScannerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \T3fx\T3fxMailscanner\Domain\Model\MailScanner
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \T3fx\T3fxMailscanner\Domain\Model\MailScanner();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getImapFolderReturnsInitialValueForImapFolder()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getImapFolder()
		);
	}

	/**
	 * @test
	 */
	public function setImapFolderForObjectStorageContainingImapFolderSetsImapFolder()
	{
		$imapFolder = new \T3fx\T3fxMailscanner\Domain\Model\ImapFolder();
		$objectStorageHoldingExactlyOneImapFolder = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneImapFolder->attach($imapFolder);
		$this->subject->setImapFolder($objectStorageHoldingExactlyOneImapFolder);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneImapFolder,
			'imapFolder',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addImapFolderToObjectStorageHoldingImapFolder()
	{
		$imapFolder = new \T3fx\T3fxMailscanner\Domain\Model\ImapFolder();
		$imapFolderObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$imapFolderObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($imapFolder));
		$this->inject($this->subject, 'imapFolder', $imapFolderObjectStorageMock);

		$this->subject->addImapFolder($imapFolder);
	}

	/**
	 * @test
	 */
	public function removeImapFolderFromObjectStorageHoldingImapFolder()
	{
		$imapFolder = new \T3fx\T3fxMailscanner\Domain\Model\ImapFolder();
		$imapFolderObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$imapFolderObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($imapFolder));
		$this->inject($this->subject, 'imapFolder', $imapFolderObjectStorageMock);

		$this->subject->removeImapFolder($imapFolder);

	}
}
