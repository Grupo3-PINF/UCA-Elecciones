import json
from web3 import Web3, HTTPProvider
import sys

w3=None

def deployContract(contract,creador,candidatos):
    construct_txn = contract.constructor(candidatos).transact({
        'from': creador,
        'nonce': w3.eth.getTransactionCount(creador),
        'gas': 1728712,
        'gasPrice': w3.toWei('21', 'gwei')})

    tx_receipt = w3.eth.waitForTransactionReceipt(construct_txn)

    return tx_receipt['contractAddress']

if __name__ == "__main__":
    w3 = Web3(HTTPProvider('http://127.0.0.1:8545'))
    #print(w3.isConnected())

    argumentos=sys.argv

    carteraCreador=argumentos[1]
    w3.geth.personal.unlockAccount(carteraCreador,'space treat blame exhibit tissue book decide fury exhaust hazard library effort',1500)

    truffleFile = json.load(open('./build/contracts/Votacion.json'))
    abi = truffleFile['abi']
    bytecode = truffleFile['bytecode']
    contrato= w3.eth.contract(bytecode=bytecode, abi=abi)

    candidatos=int(argumentos[2])
    contract_address=deployContract(contrato,carteraCreador,candidatos)

    w3.geth.personal.lockAccount(carteraCreador)

    print(contract_address)
    
    