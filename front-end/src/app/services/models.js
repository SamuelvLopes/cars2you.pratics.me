import axios from 'axios';
import { env } from '../config/env';

const baseUrl = `${env.apiUrl}/api/models`;

// Buscar todos os veículos com paginação
export const getAllModels = async () => {
  const request = await axios.get(`${baseUrl}`);
  return request.data;
};
