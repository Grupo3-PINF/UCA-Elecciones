import json
from web3 import Web3, HTTPProvider
import sys

w3=None
DIR = "/Applications/MAMP/htdocs/UCA-Elecciones/resources/vottingDapp/"

if __name__ == "__main__":
    w3 = Web3(HTTPProvider("http://127.0.0.1:8545"))
    #print(w3.isConnected())

    argumentos=sys.argv
    direccion_contrato=argumentos[1]
    creador=argumentos[2]
    estado=argumentos[3]

    w3.geth.personal.unlockAccount(creador,'space treat blame exhibit tissue book decide fury exhaust hazard library effort',1500)

    truffleFile = json.load(open(DIR+'build/contracts/Votacion.json'))
    abi = truffleFile['abi']
    bytecode = truffleFile['bytecode']
    contrato= w3.eth.contract(bytecode=bytecode, abi=abi,address=direccion_contrato)

    estadoAnterior=contrato.functions.estado().call({'from': creador})
    
    if estado=="1":
        tx = contrato.functions.abrir().transact({'from': creador,'gas':'0xa551'})
    else:
        tx = contrato.functions.cerrar().transact({'from': creador,'gas':'0xa551'})
        

    print(estadoAnterior,estado)


    w3.geth.personal.lockAccount(creador)