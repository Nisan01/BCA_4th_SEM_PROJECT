<?php
include '../../includes/config.php';

// Check if the 'data' parameter is provided in the URL
if (isset($_REQUEST['data'])) {
    // Decode the Base64-encoded data
    $encodedData = $_REQUEST['data'];
    $decodedData = base64_decode($encodedData);

    // Parse the JSON data
    $dataArray = json_decode($decodedData, true);

    if ($dataArray) {
        // Extract required parameters directly from the URL data
        $oid = isset($dataArray['transaction_uuid']) ? $dataArray['transaction_uuid'] : null;
        $amt = isset($dataArray['total_amount']) ? $dataArray['total_amount'] : null;
        $refId = isset($dataArray['transaction_code']) ? $dataArray['transaction_code'] : null;

        if ($oid && $amt && $refId) {
            
            $order_id = $oid;
            $sql = "SELECT * FROM orders WHERE order_id = '" . mysqli_real_escape_string($conn, $order_id) . "'";

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) == 1) {
           
                $order = mysqli_fetch_assoc($result);

        
                if ($amt == $order['total_price']) {
                    // Update payment status to "completed"
                    $update_sql = "UPDATE orders SET payment_status = 'completed' WHERE order_id = '" . mysqli_real_escape_string($conn, $order_id) . "'";

                    if (mysqli_query($conn, $update_sql)) {
                        // Step 3: Redirect to the success page
                        header('Location: success.php');
                        exit();
                    } else {
                        error_log("Error updating order status: " . mysqli_error($conn));
                        echo "Error updating order status.";
                    }
                } else {
                    // Update payment status to "pending" if amount mismatch
                    $update_sql = "UPDATE orders SET payment_status = 'pending' WHERE order_id = '" . mysqli_real_escape_string($conn, $order_id) . "'";

                    if (mysqli_query($conn, $update_sql)) {
                        echo "Payment verification failed. Amount mismatch. Order status set to pending.";
                    } else {
                        error_log("Error updating order status to pending: " . mysqli_error($conn));
                        echo "Error updating order status to pending.";
                    }
                }
            } else {
                error_log("Order not found for order_id = " . $order_id);
                echo "Order not found.";
            }
        } else {
            error_log("Required parameters are missing in decoded data.");
            echo "Required parameters are missing.";
        }
    } else {
        error_log("Failed to decode or parse Base64-encoded data.");
        echo "Invalid data parameter.";
    }
} else {
    error_log("Missing 'data' parameter in request.");
    echo "Required 'data' parameter is missing.";
}
?>
