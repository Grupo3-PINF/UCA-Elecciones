import json
from web3 import Web3, HTTPProvider
import sys

w3=None

if __name__ == "__main__":
    w3 = Web3(HTTPProvider("http://127.0.0.1:8545"))
    #print(w3.isConnected())

    argumentos=sys.argv
    direccion_contrato=argumentos[1]

    truffleFile = json.load(open('./build/contracts/Votacion.json'))
    abi = truffleFile['abi']
    bytecode = truffleFile['bytecode']
    contrato= w3.eth.contract(bytecode=bytecode, abi=abi,address=direccion_contrato)
    
    estado=contrato.functions.estado().call()

    if str(estado) == "0":
        tx = contrato.functions.resultados().call()
    else:
        tx="Error"

    print(tx)