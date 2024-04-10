
<?php
class ContactPopup {
    public function getEventListener() {
        return "<script>
                    document.getElementById('contactLink').addEventListener('click', function(event) {
                        event.preventDefault();
                        document.getElementById('contactPopup').style.display = 'block';
                    });
                </script>";
    }

    public function hideContactPopupScript() {
        return "<script>
                    function hideContactPopup() {
                        document.getElementById('contactPopup').style.display = 'none';
                    }
                </script>";
    }
}
?>
