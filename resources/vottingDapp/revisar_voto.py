import json
from web3 import Web3, IPCProvider
import sys

w3=None

if __name__ == "__main__":
    w3 = Web3(IPCProvider("./testNet/geth.ipc"))
    #print(w3.isConnected())

    argumentos=sys.argv
    direccion_contrato=argumentos[1]
    votante=argumentos[2]

    w3.geth.personal.unlockAccount(votante,'space treat blame exhibit tissue book decide fury exhaust hazard library effort',1500)

    truffleFile = json.load(open('./build/contracts/Votacion.json'))
    abi = truffleFile['abi']
    bytecode = truffleFile['bytecode']
    contrato= w3.eth.contract(bytecode=bytecode, abi=abi,address=direccion_contrato)
    
    estado=contrato.functions.estado().call()

    if estado==0:
        tx = contrato.functions.revisar_voto().call({'from': votante})
    else:
        tx="Error"

    w3.geth.personal.lockAccount(votante)

    print(tx)