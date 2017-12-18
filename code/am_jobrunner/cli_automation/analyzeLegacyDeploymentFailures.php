<?php
// https://ansible.weedmaps.com/api/log/3sIOrUFppNAs9W8xbcYuUianNxKjC-OW
// https://ansible.weedmaps.com/api/log/RCdcAGts82Q3BcunoTerbmbxvSOnRM12
// https://ansible.weedmaps.com/api/log/4L0LD5-SLW6orpPjsOJePDW_3m108UNo
// https://ansible.weedmaps.com/api/log/cw_bRuhdaBTrs_YZXU3QIXK_pUyVYoGo
// https://ansible.weedmaps.com/api/log/K8C61KBOnUWv8QiyNdPy5ru9kE-kUehM
// https://ansible.weedmaps.com/api/log/7n1QfE373PEPXWOdqI2Hjwn2GShUAAwU
// https://ansible.weedmaps.com/api/log/btGJNMmXyu67JpArN8pf5paSmj-X7Q2d
// https://ansible.weedmaps.com/api/log/7z3mOicieOWKmxmGRIQ1SLDUQ6xkZO6x
// https://ansible.weedmaps.com/api/log/F-bBtkiG-psg1rG1dBsAhgvhJkFLAWmR
// https://ansible.weedmaps.com/api/log/5ktLyZ-8YuxKDdDw6PSYQRn21VlxkRSK
// https://ansible.weedmaps.com/api/log/Em8lm1SLCZJr0aBRyIObKKJcc92Zd0lt
//
// Curl the ansible log
// need to get past the http password prompt
// Login: ansible
// Password: %K;#ih&64P[dhOcMFc;MK]]*Vh9ZSQBR
//

// NOTE: had to install php5-curl
$username='ansible';
$password='%K;#ih&64P[dhOcMFc;MK]]*Vh9ZSQBR';
$URL='https://ansible.weedmaps.com/api/log/Em8lm1SLCZJr0aBRyIObKKJcc92Zd0lt';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$URL);
curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
$result=curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
curl_close ($ch);
echo $result;

$regex = "/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2},\d{3} botocore\.retryhandler No retry needed\.
\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2},\d{3} p=\d* u=ubuntu \|  ERROR! Unexpected Exception: No JSON object could be decoded/";

  // 
  if(preg_match_all($regex, $result, $matches, PREG_SET_ORDER, 0) == 1) {

		// Print the entire match result
		var_dump($matches);

echo "botocore failure - please retry...";
		/*
		 * if matched submit followup job in database
		 */
    //return true;

	};
  //return false;
