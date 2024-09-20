let editingRow;

        // Function to delete a row
        function deleteRow(btn) {
            const row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        // Function to open the edit popup
        function editRow(btn) {
            editingRow = btn.parentNode.parentNode;
            const name = editingRow.cells[1].innerHTML;
            const email = editingRow.cells[2].innerHTML;

            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            
            document.getElementById('popupOverlay').style.display = "block";
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById('popupOverlay').style.display = "none";
        }

        // Function to save the changes after editing
        function saveChanges() {
            const newName = document.getElementById('editName').value;
            const newEmail = document.getElementById('editEmail').value;

            editingRow.cells[1].innerHTML = newName;
            editingRow.cells[2].innerHTML = newEmail;

            closePopup();
        }