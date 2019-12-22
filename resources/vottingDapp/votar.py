import json
from web3 import Web3, HTTPProvider
import os
import sys

w3=None
DIR = "/Applications/MAMP/htdocs/UCA-Elecciones/resources/vottingDapp/"

if __name__ == "__main__":
    w3 = Web3(HTTPProvider("http://127.0.0.1:8545"))

    argumentos=sys.argv
    direccion_contrato=argumentos[1]
    votante=argumentos[2]
    voto=argumentos[3]

    truffleFile = json.load(open(DIR+'build/contracts/Votacion.json'))
    abi = truffleFile['abi']
    bytecode = truffleFile['bytecode']
    contrato= w3.eth.contract(bytecode=bytecode, abi=abi,address=direccion_contrato)

    fichero=''
    ficheros = os.listdir(DIR+"testNet/keystore")
    cuenta=votante.replace("0x",'').lower()
    for fs in ficheros:
        if cuenta in fs:
            fichero=fs

    with open(DIR+"testNet/keystore/"+fichero) as keyfile:
        encrypted_key = keyfile.read()
        private_key = w3.eth.account.decrypt(encrypted_key, 'space treat blame exhibit tissue book decide fury exhaust hazard library effort')

    tx=contrato.functions.votar(int(voto)).buildTransaction({'from': votante,'gas':'0x100000','nonce':w3.eth.getTransactionCount(votante)})
    signed_tx = w3.eth.account.signTransaction(tx, private_key.hex())
    try:
        hash= w3.eth.sendRawTransaction(signed_tx.rawTransaction)
        
        print("1")
    except Exception as e:
        print("0",e)