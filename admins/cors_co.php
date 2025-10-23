<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://oem.dev.marmonim.com/api/v3/units/WDMiMWKCpAPiItTf6fZ6gOeA==/properties/1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\"datapoint\": {\"value\": 15}}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE4ZDRhMzBlNWVjODc3OWQ1ZDg5MmM2ZDI4Mzc0NjJlZjgyYWYwNzBjYzFlYWQwNjY3YTc0MzNlNWY3NGFlNjBmYzZlNGRlZDkyODliMDIwIn0.eyJhdWQiOiI1IiwianRpIjoiYThkNGEzMGU1ZWM4Nzc5ZDVkODkyYzZkMjgzNzQ2MmVmODJhZjA3MGNjMWVhZDA2NjdhNzQzM2U1Zjc0YWU2MGZjNmU0ZGVkOTI4OWIwMjAiLCJpYXQiOjE1ODI1Mzg4MDgsIm5iZiI6MTU4MjUzODgwOCwiZXhwIjoxNjE0MTYxMjA4LCJzdWIiOiIzMDU2NyIsInNjb3BlcyI6WyJjb25mZXJlbmNlIl19.BNo32iZp7DuyvAJDZ5ZUdUd3f2OzAgfSKDkuXxB0A7LP8MTnavJTv_Ycr2bnWhMn0rVn7pVCgxJJA_G4xiGFnwXpHlNO0XGuY8f_aluX-vyaVr80tEqkwzIr555tvxLjFB_AvtvV5zhC1CgIifOIaW3rVA4k9omRxuXacj2fFRf5uZoVYeGUpvpj3zrryA7oBr-kR-xR1yiY85JLhk4vk8EJ_ap-X7O7EvCA8BSkJ2C5JxutAss1qCPh62Agifec1sKFF2VTl1vtwncAiLSF9vtdDeWUYO7cjWF6gjrlEdP94JA4zXVyX1HK07hzvZwQLoLO_s1LIwpmw39K1kamBhexrUQGkB3U_ABs1bt8FiFj079eUY0WSyVdkVmBGqsOSmzuT1YCbtOrqDcpnJCV9ygCAjhY_5sDmGIvRrr72tjk0Z7lB4t4ICmKjvJI9Bj4hOB9Lcrb3BTdkOMJyPX1qp5tT6M5F_Toay-JCj8p84nMBIP3mGrmHx9HU5aiED99_EQ5E-Km3qXD8KruDwr8zRuQ59FkGvOfNRH_oQk34WSaTUICCWBOn3XGk7xUVtvrKZ8y7pEspx2FS5m29Hg7gRNofp9Hvd6Ripj7dVB8_LfTlubD4Ypu1qpyapcAnvCWuzxG3XIEM1pqzi1wcOhkpD5-Mv98vJjtcyiYvPqT_bg"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
