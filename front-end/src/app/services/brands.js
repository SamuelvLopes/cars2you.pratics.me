import axios from 'axios';
import { env } from '../config/env';

const baseUrl = `${env.apiUrl}/api/brands`;

export const getAllBrands = async () => {
  const request = await axios.get(`${baseUrl}`);
  return request.data;
};
