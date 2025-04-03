<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Signature</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/4.0.0/signature_pad.umd.min.js"></script>
    <style>
        #signature-pad {
            border: 2px solid #000;
            width: 100%;
            max-width: 500px;
            height: 200px;
        }
    </style>
</head>
<body>
    <h2>E-Signature</h2>
    <canvas id="signature-pad"></canvas>
    <br>
    <button id="clear">Clear</button>
    <button id="save">Save</button>

    <script>
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);

        document.getElementById('clear').addEventListener('click', function () {
            signaturePad.clear();
        });

        document.getElementById('save').addEventListener('click', function () {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
                return;
            }

            const signatureData = signaturePad.toDataURL('image/png');

            fetch("{{ route('signature.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ signature: signatureData })
            })
            .then(response => response.json())
            .then(data => alert(data.message))
            .catch(error => console.error("Error:", error));
        });
    </script>
</body>
</html>
