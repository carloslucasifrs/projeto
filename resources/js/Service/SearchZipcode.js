import axios from 'axios'

const URLAPIZipcode = 'https://viacep.com.br/ws/'
const formatReturn = '/json/'
/**
 
 * @param {string} zipcode The string
 */

export default async function searchZipcode(zipcode) {
    return new Promise(function (resolve, reject) {
        const search = axios.get(`${URLAPIZipcode}${zipcode}${formatReturn}`)
            .then((result) => {
                resolve(result.data)
            })
            .catch((error) => {
                reject('Não foi possível localizar o CEP informado ou ocorreu algum erro tente novamente')
            })
    })
}

