<?php

use Tests\TestCase;


class EncryptTest extends TestCase
{
  public function testDecrypt()
  {
    
    $cryptoService = new \App\Services\CryptoService();

    $encryptedData = '{"ct":"oenOxuAxNvxLJagINDPEPtEq/s/A8f8scl3kppvUPNSmb2+EkyEk/1cmkOnOnAB2L9rNoCJF4tPBRphuC/dXXriL2mnB0mknRV+sfFmkvzbkQFXBMSj+dbTGGz9t0SreXccCyYgWeu0MmJL11HZIQFamtudwJcTKCNjej33Nm0fXCdEV9/94J17Jnse2X346kELSgrcmXTMl2iYcOliGSFxpA8c3izzcElNSpyJQLglbwDR/O8rGqYvqnOCmGUptjVj4LQJkCwKCKB3u5cniHuyntUrjyBcoWCWgOgnHxoiNtvtCrM4gM7raF4TzQR3cEWtSZ1rouGSuKpsbN/uYlQ==","iv":"9b442312f3705e46bc32dbaf6ccc8e99","s":"e0b05d27f0b4c503"}';

    $decryptedData = $cryptoService->cryptoJsAesDecrypt($cryptoService->encryptionKey, $encryptedData);


    $this->assertEquals('1234567890123456', $decryptedData['number']);
  }

}
