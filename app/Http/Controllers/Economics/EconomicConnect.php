<?php


namespace App\Http\Controllers\Economics;

use Exception;
use SoapClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Str;

require 'config.php';

class EconomicConnect
{
    private $ecoClient;
    private $endpoint = 'https://restapi.e-conomic.com/';


    public function __construct() {

        $this->ecoClient = new SoapClient(
            'https://api.e-conomic.com/secure/api1/EconomicWebservice.asmx?WSDL',
            [
                'stream_context' => stream_context_create(['http' => ['header' => 'X-EconomicAppIdentifier: RawBite/1.0 (http://rawbite.dk/; info@interactify.dk) Interactify/1.0']])]);

        /* $this->ecoClient->Connect(array(
            'agreementNumber' => AGREEMENT_NO,
            'userName'        => ECONOMIC_USER,
            'password'        => ECONOMIC_PASSWORD
            )
        ); */

        $this->ecoClient->ConnectWithToken(array(
                'token' => '38guGima7DtfTWX8jkLpdpQ61H9pSHJLkogBbYEpws81',
                'appToken'        => 'BHTEqCFYsEqJhaYmgMEqi3uBsq3W8MA11z82RUEhYtA1'
            )
        );

    }

    public function sendRequestPsr7($method,$path,$params = [])
    {
        $headers =  [
            'X-AppSecretToken' => 'BHTEqCFYsEqJhaYmgMEqi3uBsq3W8MA11z82RUEhYtA1',
            'X-AgreementGrantToken' => '38guGima7DtfTWX8jkLpdpQ61H9pSHJLkogBbYEpws81',
            'Content-Type' =>  'application/json'
        ];

        $body = json_encode($params);
        $request = new Request($method, $this->endpoint.$path, $headers, $body);


        $response = new Response();
        echo $response->getStatusCode(); // 200
        echo $response->getProtocolVersion(); // 1.1

        $status = 200;

        $body = $request->getBody();
        $protocol = '1.1';
        $response = new Response($status, $headers, $body, $protocol);

        return $response;
    }

    public function sendWithCurl($method,$path,$params = [])
    {
        $ch = curl_init();

        $command = "curl
        --header \"Content-Type: application/json\" \
        --header \"X-AppSecretToken: BHTEqCFYsEqJhaYmgMEqi3uBsq3W8MA11z82RUEhYtA1\" \
        --header \"X-AgreementGrantToken: 38guGima7DtfTWX8jkLpdpQ61H9pSHJLkogBbYEpws81\" \
  --request POST \
  --data '".json_encode($params)."' \
  ".$this->endpoint.$path."";

        exec($command, $output, $return_var);

        $headersArray =  [
            'X-AppSecretToken' => 'BHTEqCFYsEqJhaYmgMEqi3uBsq3W8MA11z82RUEhYtA1',
            'X-AgreementGrantToken' => '38guGima7DtfTWX8jkLpdpQ61H9pSHJLkogBbYEpws81',
            'Content-Type' =>  'application/json'
        ];

        $headers = array(json_encode($headersArray));

        curl_setopt($ch, CURLOPT_URL, $this->endpoint.$path);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    public function sendRequest($method,$path,$params = [])
    {
        $app_secret = 'BHTEqCFYsEqJhaYmgMEqi3uBsq3W8MA11z82RUEhYtA1';
        $app_agreement = '38guGima7DtfTWX8jkLpdpQ61H9pSHJLkogBbYEpws81';

        $client = new Client([
            'headers' => [
                'X-AppSecretToken' => $app_secret,
                'X-AgreementGrantToken' => $app_agreement,
                'Content-Type' =>  'application/json'
            ]
        ]);

        if($method === "POST") {
            $params =  [
                'X-AppSecretToken' => $app_secret,
                'X-AgreementGrantToken' => $app_agreement,
                'Content-Type' =>  'application/json',
                'json' => $params
            ];
        }

        $response = $client->request($method, $this->endpoint.$path, $params);

        return [
            "status" => $response->getStatusCode(),
            "result" => json_decode($response->getBody(),true)
        ];
    }

    public function getAll() {
        try {
            $invoiceHandle = $this->ecoClient->Account_GetAll();

            return $invoiceHandle;
        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }
    }

    /**
     * @return array
     */
    public function getAllCustomers() {
        try {
            $result = $this->sendRequest('GET','customers?pagesize=1000');

            return $result;
        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }
    }

    /**
     * @param $customerNumber
     * @return array
     */
    public function getCustomer($customerNumber) {
        try {
            $result = $this->sendRequest('GET',"customers/$customerNumber");

            return $result;
        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }
    }

    /**
     * @param $customerNumber
     * @return array
     */
    public function deleteCustomer($customerNumber) {
        try {
            $result = $this->sendRequest('DELETE',"customers/$customerNumber");

            return $result;
        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }
    }

    /**
     * @param $params
     * @return array
     */
    public function createCustomer($params)
    {
        try {
            $result = $this->sendRequest('POST',"customers", $params);

            return $result;
        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }
    }

    /**
     * @return array
     */
    public function getEconomicOrders() {
        try {
            $result = $this->sendRequest('GET',"orders/drafts?pagesize=1000");

            return $result;
        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }
    }

    /**
     * @param $params
     * @return array
     */
    public function createEconomicOrders($params) {
        try {
            $result = $this->sendRequest('POST',"orders/drafts/",$params);

            return $result;
        } catch(Exception $e) {

            echo ($e->getMessage());
            exit;
        }
    }

    /**
     * @param $orderNumber
     * @return array
     */
    public function getEconomicOrder($orderNumber) {
        try {
            $result = $this->sendRequest('GET',"/orders/drafts/".$orderNumber."");

            return $result;
        } catch(Exception $e) {

            echo ($e->getMessage());
            exit;
        }
    }

    /**
     * @return array
     */
    public function getEconomicLayouts()
    {
        try {
            $result = $this->sendRequest('GET',"layouts");

            return $result;
        } catch(Exception $e) {

            echo ($e->getMessage());
            exit;
        }
    }

    /**
     * @return array
     */
    public function getPaymentTerms()
    {
         try {
             $result = $this->sendRequest('GET',"payment-terms");

             return $result;
         } catch(Exception $e) {

             echo ($e->getMessage());
             exit;
         }
    }

    /**
     * @param $id
     * @return array
     */
    public function getPaymentTermsById($id)
    {
         try {
             $result = $this->sendRequest('GET',"payment-terms/".$id);

             return $result;
         } catch(Exception $e) {

             echo ($e->getMessage());
             exit;
         }
    }

    /**
     * @return array
     */
    public function getAllProducts()
    {
         try {
             $result = $this->sendRequest('GET',"products");

             return $result;
         } catch(Exception $e) {

             echo ($e->getMessage());
             exit;
         }
    }

    /**
     * @return array
     */
    public function getProduct($productNumber)
    {
        try {
            $result = $this->sendRequest('GET',"products/".$productNumber);

            return $result;
        } catch(Exception $e) {

            echo ($e->getMessage());
            exit;
        }
    }

    public function grtAllInvoice()
    {
         try {
             $result = $this->sendRequest('GET',"invoices/drafts");

             return $result;
         } catch(Exception $e) {

             echo ($e->getMessage());
             exit;
         }
    }

    public function getInvoice($id)
    {
        try {
            $result = $this->sendRequest('GET',"invoices/drafts/$id");

            return $result;
        } catch(Exception $e) {
            echo ($e->getMessage());
            exit;
        }
    }

    /**
     * @param $params
     * @return array
     */
    public function createInvoiceCurl($params) {
        try {
            $result = $this->sendRequest('POST',"invoices/drafts",$params);

            return $result;
        } catch(Exception $e) {
            echo ($e->getMessage());
            exit;
        }
    }

    public function createInvoice($data)
    {
        try {
            $invoiceHandle = $this->ecoClient->CurrentInvoice_Create(array(
                'debtorHandle' => array(
                    'Number' => (int)$data['customer'],
                    'lines' => [
                        'product' => [
                            'productNumber' => $data['product']['productNumber']
                        ]
                    ]
                )
            ));

            return $invoiceHandle = $invoiceHandle->CurrentInvoice_CreateResult->Id;
        } catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }
    }

    public function setInvoiceDeliveryLocation($invoiceId, $deliveryLocation)
    {

        try {
            return $this->ecoClient->CurrentInvoice_SetDeliveryLocation(array(
                'currentInvoiceHandle' => array(
                    'Id' => (int)$invoiceId
                ),
                'valueHandle' => array(
                    'Id' => (int)$deliveryLocation
                )
            ));

        } catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function getDeliveryAddressFromLocationId($locationId)
    {

        try {
            $deliveryAdrObj = $this->ecoClient->DeliveryLocation_GetData(array(
                'entityHandle' => array(
                    'Id' => $locationId
                )
            ));

            return $deliveryAdrObj->DeliveryLocation_GetDataResult;

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function setInvoiceDeliveryAddress($invoiceId, $address) {

        try {
            $this->ecoClient->CurrentInvoice_SetDeliveryAddress(array(
                'currentInvoiceHandle' => array(
                    'Id' => $invoiceId
                ),
                'value' => $address
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function setInvoiceDeliveryPostalCode($invoiceId, $city) {

        try {
            $this->ecoClient->CurrentInvoice_SetDeliveryPostalCode(array(
                'currentInvoiceHandle' => array(
                    'Id' => $invoiceId
                ),
                'value' => $city
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function setInvoiceDeliveryCity($invoiceId, $city) {

        try {
            $this->ecoClient->CurrentInvoice_SetDeliveryCity(array(
                'currentInvoiceHandle' => array(
                    'Id' => $invoiceId
                ),
                'value' => $city
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function setInvoiceTextLine1($invoiceId, $text) {

        try {
            return $this->ecoClient->CurrentInvoice_SetTextLine1(array(
                'currentInvoiceHandle' => array(
                    'Id' => (int)$invoiceId
                ),
                'value' => (string)$text
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function setInvoiceHeading($invoiceId, $text) {

        try {
            return $this->ecoClient->CurrentInvoice_SetHeading(array(
                'currentInvoiceHandle' => array(
                    'Id' => (int)$invoiceId
                ),
                'value' => (string)$text
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function getProductData($productId) {

        try {
            return $this->ecoClient->Product_GetDataArray(array(
                'entityHandles' => array(
                    'ProductHandle' => array(
                        'Number' => $productId
                    )
                ),
            ))->Product_GetDataArrayResult->ProductData;

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function createInvoiceLine($invoiceId) {

        try {
            $invoiceLineHandle = $this->ecoClient->CurrentInvoiceLine_Create(array(
                'invoiceHandle' => array(
                    'Id' => $invoiceId
                )
            ));

            return $invoiceLineHandle->CurrentInvoiceLine_CreateResult->Number;

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function invoiceLineSetProduct($invoiceId, $invoiceLineId, $productId) {

        try {
            return $this->ecoClient->CurrentInvoiceLine_SetProduct(array(
                'currentInvoiceLineHandle' => array(
                    'Id' => $invoiceId,
                    'Number' => $invoiceLineId
                ),
                'valueHandle' => array(
                    'Number' => (string)$productId
                )
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function invoiceLineSetProductQuantity($invoiceId, $invoiceLineId, $amount) {

        try {
            return $this->ecoClient->CurrentInvoiceLine_SetQuantity(array(
                'currentInvoiceLineHandle' => array(
                    'Id' => $invoiceId,
                    'Number' => $invoiceLineId
                ),
                'value' => $amount.'.0'
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function invoiceLineSetProductName($invoiceId, $invoiceLineId, $name) {

        try {
            return $this->ecoClient->CurrentInvoiceLine_SetDescription(array(
                'currentInvoiceLineHandle' => array(
                    'Id' => $invoiceId,
                    'Number' => $invoiceLineId
                ),
                'value' => $name
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function invoiceLineSetUnit($invoiceId, $invoiceLineId, $unitId) {

        try {
            return $this->ecoClient->CurrentInvoiceLine_SetUnit(array(
                'currentInvoiceLineHandle' => array(
                    'Id' => $invoiceId,
                    'Number' => $invoiceLineId
                ),
                'valueHandle' => array(
                    'Number' => $unitId
                )
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function invoiceLineSetProductPrice($invoiceId, $invoiceLineId, $price) {

        try {
            return $this->ecoClient->CurrentInvoiceLine_SetUnitNetPrice(array(
                'currentInvoiceLineHandle' => array(
                    'Id' => $invoiceId,
                    'Number' => $invoiceLineId
                ),
                'value' => $price
            ));

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }

    }

    public function getDebtorPriceGroup($debtorHandle) {
        try {
            return $priceGroupHandle = $this->ecoClient->Debtor_GetPriceGroup(array(
                'debtorHandle' => array(
                    'Number' => $debtorHandle
                )
            ))->Debtor_GetPriceGroupResult->Number;
        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }
    }

    public function getPriceGroupPrice($priceGroupHandle, $productHandle) {
        try {
            return $this->ecoClient->PriceGroup_GetPrice(array(
                'priceGroupHandle' => array(
                    'Number' => (string)$priceGroupHandle
                ),
                'productHandle' => array(
                    'Number' => (string)$productHandle
                )
            ))->PriceGroup_GetPriceResult;

        }
        catch(Exception $e) {
            echo json_encode($e->getMessage());
            exit;
        }
    }
}