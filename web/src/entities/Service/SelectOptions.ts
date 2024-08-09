import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { ServicePropertiesList } from './ServiceProperties';
import { DropdownChoices } from '@irontec/ivoz-ui';
import store from 'store';

const ServiceSelectOptions: SelectOptionsType = ({ callback, cancelToken }): Promise<unknown> => {

  const entities = store.getState().entities.entities;
  const Service = entities.Service;

  return defaultEntityBehavior.fetchFks(
    Service.path,
    ['id', 'iden'],
    (data: ServicePropertiesList) => {

      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as number, label: item.iden as string });
      }

      callback(options);
    },
    cancelToken,
  );
};

export default ServiceSelectOptions;