# test.py
# example client to consume the stats

import ssl
import requests

# disable SSL certificate validation
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

content = {
	'Stats-Credential': '3u58o9q7kff8h9n3wvjejiqs2p1rt0yq5kw4uly26if6b53v4piuffoiy6s39ppplr9b0e9vtnbhzbml6ac5aulbemekogeqa7pa434tf13dps6uv2qenjsypepatu6u'
}

url = 'https://redaxo.local/intern/statistiken/?from=2020-03-24 23:59'

resp = requests.post(url, data=content, verify=False)

print(resp.status_code)
print(resp.text)
