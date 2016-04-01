<?php

    /**
     * SMS Wallet API
     *
     * @author www.foreto.com
     **/
    class SmsWallet
    {
        private $order_id;
        private $amount;
        private $controlSum;

        /**
         * 
         * @param string $api_key
         * @param string $api_password
         * 
         * @return null
         */
        public function __construct($api_key, $api_password)
        {
            $this->order_id = (isset($_POST['order_id'])) ? (int)$_POST['order_id'] : null;
            $this->amount = (isset($_POST['amount'])) ? (int)$_POST['amount'] : null;
            $this->controlSum = hash('sha256', "{$this->order_id}|{$this->amount}|{$api_key}|{$api_password}");
        }

        /**
         * 
         * @return integer
         */
        public function getOrderId()
        {
            return $this->order_id;
        }

        /**
         * 
         * @return integer
         */
        public function getOrderAmount()
        {
            return $this->amount;
        }

        /**
         * 
         * @return boolean
         */
        public function verification()
        {
            $control_sum = (isset($_POST['control_sum'])) ? $_POST['control_sum'] : null;

            if($this->controlSum === $control_sum) {
                return true;
            } else {
                return false;
            }
        }

    } // END class SmsWallet

?>