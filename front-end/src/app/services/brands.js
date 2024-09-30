import axios from 'axios';
import { env } from '../config/env';

const baseUrl = `${env.apiUrl}/api/brands`;

// Buscar todos os veículos com paginação
export const getAllBrands = async () => {
  const request = await axios.get(`${baseUrl}`);
  return request.data;
};
