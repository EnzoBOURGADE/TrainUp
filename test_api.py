import requests
import sys

TOKEN = "7922df9cfba167468cf614975db415841da3629b836dee760e2ffbe9d6ed0e05"
BASE_URL = "https://slam.cipecma.net/2426/ebourgade/trainup/api"

routes = [
    {"path": "/users/all", "auth": False},
    {"path": "/exercice/all", "auth": True},
    {"path": "/category/all", "auth": True},
    {"path": "/category-Program/all", "auth": True},
    {"path": "/friends/all", "auth": True},
    {"path": "/friends-request/all", "auth": True},
    {"path": "/muscles/all", "auth": True},
    {"path": "/Program/all", "auth": True},
    {"path": "/series/all", "auth": True},
    {"path": "/workout/all", "auth": True},
]

print(f"Testing API routes at {BASE_URL}...")
all_passed = True

for item in routes:
    url = f"{BASE_URL}{item['path']}"
    headers = {}
    if item["auth"]:
        headers["Authorization"] = f"Bearer {TOKEN}"

    try:
        response = requests.get(url, headers=headers)
        status = response.status_code
        if status == 200:
            print(f"[OK] 200 - {item['path']}")
        else:
            print(f"[FAIL] {status} - {item['path']}")
            print(f"      Body: {response.text[:100]}")
            all_passed = False
    except Exception as e:
        print(f"[ERROR] Could not connect to {url}: {e}")
        all_passed = False

if not all_passed:
    sys.exit(1)
else:
    print("\nAll routes functional!")
