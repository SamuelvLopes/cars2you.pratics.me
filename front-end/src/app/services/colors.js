import axios from 'axios';
import { env } from '../config/env';

const baseUrl = `${env.apiUrl}/api/colors`;

// Buscar todos os veículos com paginação
export const getAllColors = async () => {
  const request = await axios.get(`${baseUrl}`);
  return request.data;
};
