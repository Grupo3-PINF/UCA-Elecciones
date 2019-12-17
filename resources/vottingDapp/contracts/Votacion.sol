pragma solidity ^0.5.7;

contract Votacion{
    mapping(uint => address[]) private votosCandidatos;
    uint[] private votos;
    bool private abierta;

    address private creador=msg.sender;

    constructor(uint numCandidatos) public{
        votos = new uint[](numCandidatos);
        abierta = false;
        for (uint i = 0; i < numCandidatos; i++)
        {
            votosCandidatos[i] = new address[](100);
            votos[i] = 0;
        }
    }

    function ind(address[] memory v, address e) public pure returns (bool){
        bool found = false;

        for(uint i = 0; i < v.length && !found; i++)
        {
            found = v[i] == e;
        }

        return found;
    }

    function votar(uint candidato) public returns(uint){
        bool ya_votado = false;

        for (uint i = 0; i < votos.length && !ya_votado; i++)
        {
            ya_votado = ind(votosCandidatos[i],msg.sender);
        }

        if (ya_votado) revert("Ya ha ejercido su derecho a voto");
        if(!abierta) revert("La votación no es accesible en este momento");
        
        votosCandidatos[candidato].push(msg.sender);
        votos[candidato] = votos[candidato] + 1;

        return candidato;
    }

    function abrir() public{
        if(msg.sender != creador)revert ("Permiso denegado");
        abierta = true;
    }

    function cerrar() public{
        if(msg.sender != creador)revert ("Permiso denegado");
        abierta = false;
    }

    function estado() public view returns(uint)
    {
        //if(msg.sender != creador)revert ("Permiso denegado");

        uint res;

        if(abierta)
            res = 1;
        else
            res = 0;

        return res;
    }

    function revisar_voto() public view returns (uint)
    {
        //if(abierta) revert("La votación no ha terminado aun");
        bool ya_votado = false;
        uint res = 0;

        for (uint i = 0; i < votos.length && !ya_votado; i++)
        {
            ya_votado = ind(votosCandidatos[i],msg.sender);
            if(ya_votado==true) res = i;
        }

        return res;
    }

    function resultados() public view returns (uint[] memory){
        if(abierta) revert("La votación no ha terminado aun");
        uint[] memory resul = new uint[](votos.length);

        for (uint i = 0; i < votos.length; i++)
        {
            resul[i] = votos[i];
        }

        return resul;
    }
}