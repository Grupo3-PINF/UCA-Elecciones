from web3 import Web3, HTTPProvider
from os import system

if __name__ == "__main__":
    w3 = Web3(HTTPProvider('http://127.0.0.1:8545'))
    cuenta=w3.geth.personal.newAccount('space treat blame exhibit tissue book decide fury exhaust hazard library effort')

    address=w3.eth.coinbase

    w3.geth.personal.sendTransaction({'to': cuenta, 'from': address, 'value': w3.toWei(1,'ether'),'extraData': ''},'')
    print(cuenta)