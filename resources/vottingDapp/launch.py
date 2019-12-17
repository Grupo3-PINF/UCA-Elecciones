from os import system
#Comando para crear la blockchain, una vez creada no se puede utilizar de nuevo
#geth --nodiscover --datadir ./testNet -networkid 2000 -maxpeers 0 --dev console init ./testNet/genesis.json

#Comando para lanzar el servidor en local
system('geth --rpc --rpcport 8545 --rpccorsdomain "*" --targetgaslimit 9000000000000 --networkid 2000 --nodiscover --dev --rpcapi "db,eth,net,web3,personal,web3" -allow-insecure-unlock --datadir "./testNet" --cache=4096 --syncmode=fast --verbosity 5 console 2>> geth.log')